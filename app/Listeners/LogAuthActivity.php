<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Events\UserLoggedOut;
use App\Events\UserRegistered;
use App\Models\ActivityLog;
use App\Models\SecurityLog;
use App\Models\Session;

class LogAuthActivity
{
    public function __invoke(UserLoggedIn|UserRegistered|UserLoggedOut $event): void
    {
        match (true) {
            $event instanceof UserLoggedIn => $this->handleLogin($event),
            $event instanceof UserLoggedOut => $this->handleLogout($event),
            $event instanceof UserRegistered => $this->handleRegister($event),
        };
    }

    private function handleLogin(UserLoggedIn $event): void
    {
        ActivityLog::create([
            'user_id' => $event->user->id,
            'action' => 'login',
            'description' => 'User logged in successfully',
            'ip_address' => $event->ipAddress,
        ]);

        SecurityLog::create([
            'user_id' => $event->user->id,
            'event' => 'login',
            'ip_address' => $event->ipAddress,
            'details' => 'Successful login from ' . ($event->userAgent ?? 'unknown device'),
        ]);
    }

    private function handleRegister(UserRegistered $event): void
    {
        ActivityLog::create([
            'user_id' => $event->user->id,
            'action' => 'register',
            'description' => 'New user registered',
        ]);
    }

    private function handleLogout(UserLoggedOut $event): void
    {
        ActivityLog::create([
            'user_id' => $event->user->id,
            'action' => 'logout',
            'description' => 'User logged out',
        ]);
    }

    private function getDeviceType(?string $userAgent): string
    {
        if (!$userAgent) return 'unknown';

        $ua = strtolower($userAgent);

        if (str_contains($ua, 'mobile') || str_contains($ua, 'android')) {
            return 'mobile';
        }
        if (str_contains($ua, 'tablet') || str_contains($ua, 'ipad')) {
            return 'tablet';
        }
        if (str_contains($ua, 'bot')) {
            return 'bot';
        }

        return 'desktop';
    }
}