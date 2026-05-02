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
    public function handleUserLoggedIn(UserLoggedIn $event): void
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

        Session::create([
            'user_id' => $event->user->id,
            'ip_address' => $event->ipAddress,
            'user_agent' => $event->userAgent,
            'device_type' => $this->getDeviceType($event->userAgent),
            'last_activity' => now(),
        ]);
    }

    public function handleUserRegistered(UserRegistered $event): void
    {
        ActivityLog::create([
            'user_id' => $event->user->id,
            'action' => 'register',
            'description' => 'New user registered',
        ]);
    }

    public function handleUserLoggedOut(UserLoggedOut $event): void
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

    public function subscribe($eventDispatcher): void
    {
        $eventDispatcher->listen(UserLoggedIn::class, [$this, 'handleUserLoggedIn']);
        $eventDispatcher->listen(UserRegistered::class, [$this, 'handleUserRegistered']);
        $eventDispatcher->listen(UserLoggedOut::class, [$this, 'handleUserLoggedOut']);
    }
}