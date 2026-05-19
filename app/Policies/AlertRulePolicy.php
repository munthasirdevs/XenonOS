<?php

namespace App\Policies;

use App\Models\AlertRule;
use App\Models\User;

class AlertRulePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('alert_rule.view');
    }

    public function view(User $user, AlertRule $alertRule): bool
    {
        return $user->hasPermission('alert_rule.view') && $alertRule->created_by === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('alert_rule.create');
    }

    public function update(User $user, AlertRule $alertRule): bool
    {
        return $user->hasPermission('alert_rule.update') && $alertRule->created_by === $user->id;
    }

    public function delete(User $user, AlertRule $alertRule): bool
    {
        return $user->hasPermission('alert_rule.delete') && $alertRule->created_by === $user->id;
    }

    public function toggle(User $user, AlertRule $alertRule): bool
    {
        return $user->hasPermission('alert_rule.update') && $alertRule->created_by === $user->id;
    }

    public function execute(User $user, AlertRule $alertRule): bool
    {
        return $user->hasPermission('alert_rule.execute') && $alertRule->created_by === $user->id;
    }
}