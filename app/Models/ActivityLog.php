<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'description',
        'ip_address',
        'module',
        'severity',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    // Appends disabled to prevent N+1 — compute in controller/cache instead
    // protected $appends = ['computed_severity', 'computed_module'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getComputedSeverityAttribute(): string
    {
        if ($this->severity) {
            return $this->severity;
        }

        $criticalActions = ['role', 'permission', 'delete', 'ban', 'suspend', 'security'];
        $infoActions = ['login', 'logout', 'view', 'export', 'download', 'create'];

        $actionLower = strtolower($this->action);

        foreach ($criticalActions as $critical) {
            if (str_contains($actionLower, $critical)) {
                return 'critical';
            }
        }

        foreach ($infoActions as $info) {
            if (str_contains($actionLower, $info)) {
                return 'info';
            }
        }

        return 'normal';
    }

    public function getComputedModuleAttribute(): string
    {
        if ($this->module) {
            return $this->module;
        }

        $actionLower = strtolower($this->action);
        $descriptionLower = strtolower($this->description ?? '');

        $moduleKeywords = [
            'Security' => ['role', 'permission', 'login', 'logout', 'security', 'auth', 'password'],
            'Clients' => ['client', 'customer', 'contact'],
            'Files' => ['file', 'upload', 'download', 'folder', 'document'],
            'Billing' => ['payment', 'invoice', 'billing', 'transaction', 'subscription'],
            'Projects' => ['project', 'task', 'workspace', 'team'],
            'Users' => ['user', 'register', 'profile'],
            'Settings' => ['settings', 'config', 'preference'],
        ];

        foreach ($moduleKeywords as $module => $keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains($actionLower, $keyword) || str_contains($descriptionLower, $keyword)) {
                    return $module;
                }
            }
        }

        return 'System';
    }

    public function scopeByModule(Builder $query, string $module): Builder
    {
        return $query->where('module', $module);
    }

    public function scopeBySeverity(Builder $query, string $severity): Builder
    {
        return $query->where('severity', $severity);
    }

    public function scopeDateRange(Builder $query, string $startDate, string $endDate): Builder
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeRecent(Builder $query, int $days = 7): Builder
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}