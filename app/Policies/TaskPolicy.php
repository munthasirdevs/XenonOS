<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('task.view');
    }

    public function view(User $user, Task $task): bool
    {
        return $user->hasPermission('task.view') && $this->hasAccess($user, $task);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('task.create');
    }

    public function update(User $user, Task $task): bool
    {
        return $user->hasPermission('task.update') && $this->hasAccess($user, $task);
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->hasPermission('task.delete') && $this->hasAccess($user, $task);
    }

    public function assign(User $user, Task $task): bool
    {
        return $user->hasPermission('task.assign') && $this->hasAccess($user, $task);
    }

    private function hasAccess(User $user, Task $task): bool
    {
        if ($task->project) {
            return $task->project->created_by === $user->id || 
                   $task->project->teamMembers()->where('user_id', $user->id)->exists() ||
                   $task->assignee_id === $user->id;
        }
        return $task->assignee_id === $user->id;
    }
}