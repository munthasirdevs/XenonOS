<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;

class SettingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('setting.view');
    }

    public function view(User $user, Setting $setting): bool
    {
        return $user->hasPermission('setting.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('setting.create');
    }

    public function update(User $user, Setting $setting): bool
    {
        if ($setting->key === 'system.*') {
            return $user->hasPermission('setting.system');
        }
        return $user->hasPermission('setting.update');
    }

    public function delete(User $user, Setting $setting): bool
    {
        if ($setting->key === 'system.*') {
            return $user->hasPermission('setting.system');
        }
        return $user->hasPermission('setting.delete');
    }
}