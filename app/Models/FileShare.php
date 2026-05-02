<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileShare extends Model
{
    protected $fillable = [
        'file_id',
        'user_id',
        'permission',
    ];

    protected function casts(): array
    {
        return [
            'permission' => 'string',
        ];
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}