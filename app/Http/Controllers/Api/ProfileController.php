<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use ApiResponse;

    public function show(Request $request)
    {
        $user = $request->user()->load('profile');
        
        return $this->success($user);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        
        $user->update($request->only('name'));

        if ($user->profile) {
            $user->profile->update($request->only('phone', 'bio', 'timezone', 'address'));
        } else {
            Profile::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'bio' => $request->bio,
                'timezone' => $request->timezone ?? 'UTC',
                'address' => $request->address,
            ]);
        }

        return $this->success(
            $user->load('profile'),
            'Profile updated successfully'
        );
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $user = $request->user();

        if ($user->profile && $user->profile->avatar) {
            Storage::disk('public')->delete($user->profile->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');

        if (!$user->profile) {
            Profile::create([
                'user_id' => $user->id,
                'avatar' => $path,
                'timezone' => 'UTC',
            ]);
        } else {
            $user->profile->update(['avatar' => $path]);
        }

        return $this->success(['avatar' => $path], 'Avatar updated successfully');
    }
}