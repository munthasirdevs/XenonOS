<?php

namespace App\Policies;

use App\Models\ApiKey;
use App\Models\User;

class ApiKeyPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('api_key.view');
    }

    public function view(User $user, ApiKey $apiKey): bool
    {
        return $apiKey->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('api_key.create');
    }

    public function update(User $user, ApiKey $apiKey): bool
    {
        return $apiKey->user_id === $user->id;
    }

    public function delete(User $user, ApiKey $apiKey): bool
    {
        return $apiKey->user_id === $user->id;
    }

    public function regenerate(User $user, ApiKey $apiKey): bool
    {
        return $apiKey->user_id === $user->id;
    }
}