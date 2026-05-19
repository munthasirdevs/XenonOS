<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'last_login_at',
        'timezone',
        'date_format',
        'email_notifications',
        'push_notifications',
        'marketing_emails',
        'survey_invites',
        'quiet_hours_start',
        'quiet_hours_end',
        'plan_type',
        'two_factor_secret',
        'security_score',
        'chat_channels',
        'notification_matrix',
        'auth_rules',
        'last_export_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'last_login_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'timezone' => 'string',
            'date_format' => 'string',
            'security_score' => 'integer',
            'chat_channels' => 'array',
            'notification_matrix' => 'array',
            'auth_rules' => 'array',
            'last_export_at' => 'datetime',
        ];
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user')
                    ->withTimestamps();
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role')
            ->using(\App\Models\Role::class)
            ->withTimestamps();
    }

    public function getAllPermissions(): array
    {
        $rolePermissions = $this->roles()
            ->with('permissions')
            ->get()
            ->pluck('permissions.*.slug')
            ->flatten()
            ->unique()
            ->values()
            ->toArray();

        return array_unique($rolePermissions);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(UserNotification::class, 'user_id');
    }

    public function unreadNotifications(): HasMany
    {
        return $this->hasMany(UserNotification::class, 'user_id')->whereNull('read_at');
    }

    public function apiKeys(): HasMany
    {
        return $this->hasMany(ApiKey::class);
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'owner_id');
    }

    public function teamMemberships(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_members')
                    ->withTimestamps();
    }

    public function chats(): BelongsToMany
    {
        return $this->belongsToMany(Chat::class, 'chat_users')
                    ->withTimestamps();
    }

    public function clientNotifications(): BelongsToMany
    {
        return $this->belongsToMany(Notification::class, 'user_notifications')
                    ->withPivot('read_at')
                    ->withTimestamps();
    }

    public function createdClients(): HasMany
    {
        return $this->hasMany(Client::class, 'created_by');
    }

    public function createdProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    public function createdTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    public function assignedTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function securityLogs(): HasMany
    {
        return $this->hasMany(SecurityLog::class);
    }

    public function hasRole(string $role): bool
    {
        return $this->roles()->where('slug', $role)->exists();
    }

    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('slug', $roles)->exists();
    }

    public function getRoleAttribute(): string
    {
        return \Cache::remember("user_role_{$this->id}", 3600, function () {
            return $this->roles()->first()?->name ?? 'User';
        });
    }

    public function clearRoleCache(): void
    {
        \Cache::forget("user_role_{$this->id}");
    }

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->cachedPermissions());
    }

    public function hasAllPermissions(array $permissions): bool
    {
        $userPermissions = $this->cachedPermissions();
        foreach ($permissions as $permission) {
            if (!in_array($permission, $userPermissions)) {
                return false;
            }
        }
        return true;
    }

    public function cachedPermissions(): array
    {
        return \Cache::remember("user_permissions_{$this->id}", 900, function () {
            return $this->getAllPermissions();
        });
    }

    public function clearPermissionCache(): void
    {
        \Cache::forget("user_permissions_{$this->id}");
    }

    public function getAllPermissionsAttribute(): array
    {
        return $this->getAllPermissions();
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isBanned(): bool
    {
        return $this->status === 'banned';
    }
}