<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('project.view');
    }

    public function view(User $user, Project $project): bool
    {
        return $user->hasPermission('project.view') && $this->isOwnerOrMember($user, $project);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('project.create');
    }

    public function update(User $user, Project $project): bool
    {
        return $user->hasPermission('project.update') && $this->isOwnerOrMember($user, $project);
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->hasPermission('project.delete') && $this->isOwner($user, $project);
    }

    public function assignUsers(User $user, Project $project): bool
    {
        return $user->hasPermission('project.assign') && $this->isOwnerOrMember($user, $project);
    }

    private function isOwnerOrMember(User $user, Project $project): bool
    {
        return $project->created_by === $user->id || 
               $project->teamMembers()->where('user_id', $user->id)->exists();
    }

    private function isOwner(User $user, Project $project): bool
    {
        return $project->created_by === $user->id;
    }
}