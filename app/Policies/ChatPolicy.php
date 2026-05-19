<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;

class ChatPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('chat.view');
    }

    public function view(User $user, Chat $chat): bool
    {
        return $chat->participants()->where('user_id', $user->id)->exists();
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('chat.create');
    }

    public function update(User $user, Chat $chat): bool
    {
        return $this->isParticipant($user, $chat);
    }

    public function delete(User $user, Chat $chat): bool
    {
        return $this->isParticipant($user, $chat);
    }

    private function isParticipant(User $user, Chat $chat): bool
    {
        return $chat->participants()->where('user_id', $user->id)->exists();
    }
}