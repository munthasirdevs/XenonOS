<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'phone',
        'address',
        'bio',
        'timezone',
        'preferences',
        'title',
        'company',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'country',
        'payment_method',
    ];

    protected function casts(): array
    {
        return [
            'preferences' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}