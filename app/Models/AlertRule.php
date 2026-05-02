<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlertRule extends Model
{
    protected $fillable = [
        'name',
        'trigger_type',
        'condition',
        'action',
        'config',
        'is_active',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'condition' => 'array',
            'config' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function triggerTypes()
    {
        return [
            'task_overdue',
            'task_due_soon',
            'payment_due',
            'payment_overdue',
            'project_scheduled',
            'client_inactive',
        ];
    }

    public static function actions()
    {
        return [
            'send_notification',
            'send_email',
            'update_status',
            'create_task',
        ];
    }
}