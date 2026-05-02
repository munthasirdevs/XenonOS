<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'path',
        'size',
        'mime_type',
        'uploaded_by',
        'category_id',
    ];

    protected function casts(): array
    {
        return [
            'size' => 'integer',
        ];
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function sharedWith(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'file_shares')
                    ->withPivot('permission')
                    ->withTimestamps();
    }

    public function logs(): HasMany
    {
        return $this->hasMany(FileLog::class);
    }

    public function shares(): HasMany
    {
        return $this->hasMany(FileShare::class);
    }
}