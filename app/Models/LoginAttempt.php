<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    protected $fillable = ['ip_address', 'email', 'attempts', 'locked_until'];

    protected function casts(): array
    {
        return [
            'locked_until' => 'datetime',
        ];
    }

    public static function recordFailedAttempt(string $ip, ?string $email = null): self
    {
        $attempt = self::where('ip_address', $ip)->first();
        
        if (!$attempt) {
            $attempt = self::create([
                'ip_address' => $ip,
                'email' => $email,
                'attempts' => 1,
            ]);
        } else {
            $attempt->increment('attempts');
            $attempt->update(['email' => $email]);
            
            // Progressive locking based on attempt count
            $lockTimes = [
                5 => 1,   // 5 attempts = 1 minute lock
                10 => 3,  // 10 attempts = 3 minutes
                15 => 5,  // 15 attempts = 5 minutes
                20 => 15, // 20 attempts = 15 minutes
                25 => 30, // 25 attempts = 30 minutes
            ];
            
            foreach ($lockTimes as $count => $minutes) {
                if ($attempt->attempts >= $count) {
                    $attempt->update(['locked_until' => now()->addMinutes($minutes)]);
                }
            }
        }
        
        return $attempt;
    }

    public static function isLocked(string $ip): bool
    {
        $attempt = self::where('ip_address', $ip)->first();
        
        if (!$attempt || !$attempt->locked_until) {
            return false;
        }
        
        if ($attempt->locked_until->isPast()) {
            // Lock expired, reset attempts
            $attempt->update([
                'attempts' => 0,
                'locked_until' => null,
            ]);
            return false;
        }
        
        return true;
    }

    public static function getLockRemaining(string $ip): ?int
    {
        $attempt = self::where('ip_address', $ip)->first();
        
        if (!$attempt || !$attempt->locked_until) {
            return null;
        }
        
        if ($attempt->locked_until->isPast()) {
            return null;
        }
        
        return now()->diffInSeconds($attempt->locked_until);
    }

    public static function clearLock(string $ip): void
    {
        self::where('ip_address', $ip)->update([
            'attempts' => 0,
            'locked_until' => null,
        ]);
    }

    public static function logSuspicious(string $ip, int $attempts): void
    {
        SecurityLog::create([
            'user_id' => null,
            'event' => 'suspicious_activity',
            'ip_address' => $ip,
            'details' => "Suspicious login pattern detected. {$attempts} failed attempts from IP.",
        ]);
    }
}