<?php

namespace App\Policies;

use App\Models\Subscription;
use App\Models\User;

class SubscriptionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('subscription.view');
    }

    public function view(User $user, Subscription $subscription): bool
    {
        return $subscription->user_id === $user->id || $user->hasPermission('subscription.manage');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('subscription.create');
    }

    public function update(User $user, Subscription $subscription): bool
    {
        return $subscription->user_id === $user->id || $user->hasPermission('subscription.manage');
    }

    public function cancel(User $user, Subscription $subscription): bool
    {
        return $subscription->user_id === $user->id || $user->hasPermission('subscription.manage');
    }

    public function renew(User $user, Subscription $subscription): bool
    {
        return $subscription->user_id === $user->id || $user->hasPermission('subscription.manage');
    }
}