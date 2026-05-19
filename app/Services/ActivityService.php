<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\SecurityLog;
use Illuminate\Support\Facades\Cache;

class ActivityService
{
    public function log(int $userId, string $action, string $description, ?string $entityType = null, ?int $entityId = null): ActivityLog
    {
        return ActivityLog::create([
            'user_id' => $userId,
            'action' => $action,
            'description' => $description,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    public function getUserActivity(int $userId, int $limit = 50): \Illuminate\Database\Eloquent\Collection
    {
        return ActivityLog::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getEntityHistory(string $entityType, int $entityId): \Illuminate\Database\Eloquent\Collection
    {
        return ActivityLog::where('entity_type', $entityType)
            ->where('entity_id', $entityId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getActivityStats(int $userId, int $days = 30): array
    {
        $cacheKey = "activity_stats_{$userId}_{$days}";
        
        return Cache::remember($cacheKey, 300, function () use ($userId, $days) {
            $startDate = now()->subDays($days);
            
            $activities = ActivityLog::where('user_id', $userId)
                ->where('created_at', '>=', $startDate)
                ->get();
                
            $byDay = $activities->groupBy(function ($activity) {
                return $activity->created_at->toDateString();
            })->map(fn($g) => $g->count())->toArray();
            
            $byAction = $activities->groupBy('action')->map(fn($g) => $g->count())->toArray();
            
            return [
                'total' => $activities->count(),
                'by_day' => $byDay,
                'by_action' => $byAction,
            ];
        });
    }

    public function getRecentActivity(int $userId, int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return ActivityLog::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function securityLog(int $userId, string $event, string $description, ?string $ip = null): SecurityLog
    {
        return SecurityLog::create([
            'user_id' => $userId,
            'event' => $event,
            'description' => $description,
            'ip_address' => $ip ?? request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    public function getSecurityLogs(int $userId, int $limit = 50): \Illuminate\Database\Eloquent\Collection
    {
        return SecurityLog::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}