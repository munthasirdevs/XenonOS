<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    protected $fillable = [
        'name',
        'config',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'config' => 'array',
        ];
    }
}