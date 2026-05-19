<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;

class ClientPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('client.view');
    }

    public function view(User $user, Client $client): bool
    {
        return $user->hasPermission('client.view') && $this->isOwnerOrMember($user, $client);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('client.create');
    }

    public function update(User $user, Client $client): bool
    {
        return $user->hasPermission('client.update') && $this->isOwnerOrMember($user, $client);
    }

    public function delete(User $user, Client $client): bool
    {
        return $user->hasPermission('client.delete') && $this->isOwner($user, $client);
    }

    private function isOwnerOrMember(User $user, Client $client): bool
    {
        return $client->created_by === $user->id || 
               $client->teamMembers()->where('user_id', $user->id)->exists();
    }

    private function isOwner(User $user, Client $client): bool
    {
        return $client->created_by === $user->id;
    }
}