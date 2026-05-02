<?php

namespace App\Http\Controllers\Api;

use App\Events\UserLoggedIn;
use App\Events\UserLoggedOut;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            \App\Models\SecurityLog::create([
                'user_id' => $user?->id,
                'event' => 'failed_login',
                'ip_address' => $request->ip(),
                'details' => 'Failed login attempt for email: ' . $request->email,
            ]);

            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if ($user->status === 'banned') {
            return $this->error('Your account has been banned.', 403);
        }

        $user->update(['last_login_at' => now()]);

        event(new UserLoggedIn($user, $request->ip(), $request->userAgent()));

        $token = $user->createToken('auth-token')->plainTextToken;

        return $this->success([
            'user' => $user->load('profile', 'roles'),
            'token' => $token,
        ], 'Login successful');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'active',
        ]);

        Profile::create([
            'user_id' => $user->id,
            'timezone' => 'UTC',
        ]);

        $defaultRole = Role::where('slug', 'user')->first();
        if ($defaultRole) {
            $user->roles()->attach($defaultRole->id);
        }

        event(new UserRegistered($user));

        $token = $user->createToken('auth-token')->plainTextToken;

        return $this->success([
            'user' => $user->load('profile', 'roles'),
            'token' => $token,
        ], 'Registration successful', 201);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        
        event(new UserLoggedOut($user));

        $user->currentAccessToken()->delete();

        return $this->success(null, 'Logout successful');
    }

    public function me(Request $request)
    {
        return $this->success($request->user()->load('profile', 'roles', 'permissions'));
    }

    // Web Login (Session-based)
    public function loginWeb(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'The provided credentials are incorrect.'])->withInput();
        }

        if ($user->status === 'banned') {
            return back()->withErrors(['email' => 'Your account has been banned.'])->withInput();
        }

        auth()->login($user, $request->boolean('remember'));

        $user->update(['last_login_at' => now()]);

        \App\Models\SecurityLog::create([
            'user_id' => $user->id,
            'event' => 'web_login',
            'ip_address' => $request->ip(),
        ]);

        event(new UserLoggedIn($user, $request->ip(), $request->userAgent()));

        return redirect()->intended('/dashboard')->with('success', 'Welcome back!');
    }

    // Web Logout (Session-based)
    public function logoutWeb(Request $request)
    {
        $user = auth()->user();
        
        if ($user) {
            event(new UserLoggedOut($user));
            
            \App\Models\SecurityLog::create([
                'user_id' => $user->id,
                'event' => 'web_logout',
                'ip_address' => $request->ip(),
            ]);
        }

        auth()->logout();
        
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}