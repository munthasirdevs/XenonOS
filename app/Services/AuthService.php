<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Models\LoginAttempt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;

class AuthService
{
    public function login(string $email, string $password, ?string $ip = null): ?User
    {
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->logFailedAttempt($email, $ip, 'user_not_found');
            return null;
        }
        
        if (!Hash::check($password, $user->password)) {
            $this->logFailedAttempt($user->id, $ip, 'wrong_password', $email);
            return null;
        }
        
        if ($user->status === 'banned') {
            $this->logFailedAttempt($user->id, $ip, 'banned_account', $email);
            return null;
        }
        
        Auth::login($user);
        event(new Login('sanctum', $user, true));
        
        $this->clearFailedAttempts($user->id);
        
        return $user;
    }

    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'active',
        ]);
        
        return $user;
    }

    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }

    public function isLockedOut(string $email): bool
    {
        $recentAttempts = LoginAttempt::where('email', $email)
            ->where('created_at', '>=', now()->subMinutes(15))
            ->count();
            
        return $recentAttempts >= 5;
    }

    public function enable2FA(User $user, string $secret): User
    {
        $user->update([
            'two_factor_enabled' => true,
            'two_factor_secret' => $secret,
        ]);
        
        return $user;
    }

    public function disable2FA(User $user): User
    {
        $user->update([
            'two_factor_enabled' => false,
            'two_factor_secret' => null,
        ]);
        
        return $user;
    }

    public function verify2FA(User $user, string $code): bool
    {
        if (!$user->two_factor_enabled || !$user->two_factor_secret) {
            return false;
        }
        
        return (new \PragmaRX\Google2FA\Google2FA())->verifyKey($user->two_factor_secret, $code);
    }

    private function logFailedAttempt(int|string $identifier, ?string $ip, string $reason, ?string $email = null): void
    {
        LoginAttempt::create([
            'email' => $email ?? $identifier,
            'ip_address' => $ip,
            'user_id' => is_int($identifier) ? $identifier : null,
            'status' => 'failed',
            'reason' => $reason,
        ]);
    }

    private function clearFailedAttempts(int $userId): void
    {
        LoginAttempt::where('user_id', $userId)->delete();
    }
}