<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
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
        'share_hash',
        'share_expires_at',
        'share_password_hash',
        'share_views_used',
        'share_views_limit',
        'share_access',
        'share_enabled',
        'share_created_at',
    ];

    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'share_expires_at' => 'datetime',
            'share_created_at' => 'datetime',
        ];
    }

    public static function generateShareHash()
    {
        return 'xenon' . substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 16);
    }

    public function generateShareLink($options = [])
    {
        $this->share_hash = self::generateShareHash();
        
        if (!empty($options['expiration']) && $options['expiration'] !== 'never') {
            $this->share_expires_at = match($options['expiration']) {
                '1h' => now()->addHour(),
                '1d' => now()->addDay(),
                '7d' => now()->addDays(7),
                '30d' => now()->addDays(30),
                default => null,
            };
        }
        
        if (!empty($options['password'])) {
            $this->share_password_hash = Hash::make($options['password']);
        }
        
        $this->share_views_limit = $options['views_limit'] === 'unlimited' ? null : ($options['views_limit'] ?? null);
        $this->share_access = $options['access'] ?? 'view';
        $this->share_enabled = true;
        $this->share_created_at = now();
        $this->share_views_used = 0;
        
        $this->save();
        
        return $this->getShareUrl();
    }

    public function validateShareAccess($password = null)
    {
        if (!$this->share_enabled) {
            return ['valid' => false, 'error' => 'Share link is disabled'];
        }
        
        if ($this->share_expires_at && now()->gt($this->share_expires_at)) {
            return ['valid' => false, 'error' => 'Share link has expired'];
        }
        
        if ($this->share_views_limit !== null && $this->share_views_used >= $this->share_views_limit) {
            return ['valid' => false, 'error' => 'Share link has reached view limit'];
        }
        
        if ($this->share_password_hash && !Hash::check($password ?? '', $this->share_password_hash)) {
            return ['valid' => false, 'error' => 'Incorrect password', 'requires_password' => true];
        }
        
        return ['valid' => true];
    }

    public function recordShareView()
    {
        $this->increment('share_views_used');
    }

    public function disableShare()
    {
        $this->share_enabled = false;
        $this->save();
    }

    public function getShareUrl()
    {
        return route('files.share.view', $this->share_hash);
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