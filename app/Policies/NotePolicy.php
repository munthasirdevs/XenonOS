<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;

class NotePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('note.view');
    }

    public function view(User $user, Note $note): bool
    {
        return $note->created_by === $user->id || 
               $note->sharedWith()->where('user_id', $user->id)->exists();
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('note.create');
    }

    public function update(User $user, Note $note): bool
    {
        return $note->created_by === $user->id;
    }

    public function delete(User $user, Note $note): bool
    {
        return $note->created_by === $user->id;
    }
}