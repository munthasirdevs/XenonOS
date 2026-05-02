<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Integration extends Model
{
    protected $fillable = [
        'name',
        'type',
        'config',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'config' => 'array',
            'status' => 'boolean',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function types()
    {
        return [
            'payment',
            'email',
            'sms',
            'storage',
            'webhook',
            'api',
        ];
    }

    public function isActive(): bool
    {
        return $this->status;
    }

    public function getConfig(string $key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }
}