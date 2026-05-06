<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Session extends Model
{
    protected $table = 'sessions';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'device_type',
        'last_activity',
        'expires_at',
        'device_info',
        'location',
        'browser',
        'os',
    ];

    protected function casts(): array
    {
        return [
            'last_activity' => 'integer',
            'expires_at' => 'datetime',
            'device_info' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isActive(): bool
    {
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return $this->last_activity >= now()->subMinutes(config('session.lifetime', 120))->getTimestamp();
    }

    public function getDurationAttribute(): string
    {
        $lastActivity = $this->last_activity;
        if (is_numeric($lastActivity)) {
            $lastActivity = \Carbon\Carbon::createFromTimestamp($lastActivity);
        }

        $diff = $lastActivity->diff(now());

        if ($diff->d > 0) {
            return $diff->d . 'd ' . $diff->h . 'h';
        }
        if ($diff->h > 0) {
            return $diff->h . 'h ' . $diff->i . 'm';
        }
        return $diff->i . 'm';
    }

    public function getDeviceNameAttribute(): string
    {
        if ($this->device_type === 'mobile') {
            return 'Mobile Device';
        }
        if ($this->device_type === 'tablet') {
            return 'Tablet';
        }

        return $this->os ?? 'Desktop';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('last_activity', '>=', now()->subMinutes(config('session.lifetime', 120))->getTimestamp())
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    public function scopeUserSessions(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public static function detectDevice(?string $userAgent): array
    {
        if (!$userAgent) {
            return ['type' => 'desktop', 'browser' => 'Unknown', 'os' => 'Unknown'];
        }

        $ua = strtolower($userAgent);

        $deviceType = 'desktop';
        if (str_contains($ua, 'mobile') || str_contains($ua, 'android')) {
            $deviceType = 'mobile';
        } elseif (str_contains($ua, 'tablet') || str_contains($ua, 'ipad')) {
            $deviceType = 'tablet';
        }

        $browser = 'Unknown';
        if (str_contains($ua, 'chrome')) {
            $browser = 'Chrome';
        } elseif (str_contains($ua, 'firefox')) {
            $browser = 'Firefox';
        } elseif (str_contains($ua, 'safari')) {
            $browser = 'Safari';
        } elseif (str_contains($ua, 'edge')) {
            $browser = 'Edge';
        } elseif (str_contains($ua, 'opera')) {
            $browser = 'Opera';
        }

        $os = 'Unknown';
        if (str_contains($ua, 'windows')) {
            $os = 'Windows';
        } elseif (str_contains($ua, 'mac os')) {
            $os = 'macOS';
        } elseif (str_contains($ua, 'linux')) {
            $os = 'Linux';
        } elseif (str_contains($ua, 'android')) {
            $os = 'Android';
        } elseif (str_contains($ua, 'ios') || str_contains($ua, 'iphone') || str_contains($ua, 'ipad')) {
            $os = 'iOS';
        }

        return [
            'type' => $deviceType,
            'browser' => $browser,
            'os' => $os,
        ];
    }
}