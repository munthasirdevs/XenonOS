<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;

class FilePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('file.view');
    }

    public function view(User $user, File $file): bool
    {
        return $this->isOwnerOrShared($user, $file);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('file.upload');
    }

    public function update(User $user, File $file): bool
    {
        return $user->hasPermission('file.update') && $this->isOwner($user, $file);
    }

    public function delete(User $user, File $file): bool
    {
        return $user->hasPermission('file.delete') && $this->isOwner($user, $file);
    }

    public function download(User $user, File $file): bool
    {
        return $this->isOwnerOrShared($user, $file);
    }

    public function share(User $user, File $file): bool
    {
        return $this->isOwner($user, $file);
    }

    private function isOwner(User $user, File $file): bool
    {
        return $file->created_by === $user->id;
    }

    private function isOwnerOrShared(User $user, File $file): bool
    {
        if ($this->isOwner($user, $file)) {
            return true;
        }
        return $file->sharedWith()->where('user_id', $user->id)->exists();
    }
}