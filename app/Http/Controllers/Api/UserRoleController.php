<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignRoleRequest;
use App\Models\AuditLog;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    use ApiResponse;

    public function index(Request $request, User $user)
    {
        return $this->success($user->load('roles'));
    }

    public function assignRole(AssignRoleRequest $request, User $user)
    {
        $role = Role::findOrFail($request->role_id);

        if ($user->hasRole($role->slug)) {
            return $this->error('User already has this role.', 400);
        }

        $oldRoles = $user->roles()->pluck('roles.slug')->toArray();
        
        $user->roles()->attach($role->id);

        AuditLog::create([
            'model_type' => User::class,
            'model_id' => $user->id,
            'changes' => ['before' => $oldRoles, 'after' => array_merge($oldRoles, [$role->slug])],
            'created_by' => $request->user()->id,
            'action' => 'role_assigned',
            'description' => "Role '{$role->name}' assigned to user '{$user->name}'",
        ]);

        \Cache::forget("user_permissions_{$user->id}");

        return $this->success($user->load('roles'), 'Role assigned successfully');
    }

    public function removeRole(Request $request, User $user, Role $role)
    {
        if (!$user->hasRole($role->slug)) {
            return $this->error('User does not have this role.', 400);
        }

        $oldRoles = $user->roles()->pluck('roles.slug')->toArray();
        
        $user->roles()->detach($role->id);

        AuditLog::create([
            'model_type' => User::class,
            'model_id' => $user->id,
            'changes' => ['before' => $oldRoles, 'after' => array_diff($oldRoles, [$role->slug])],
            'created_by' => $request->user()->id,
            'action' => 'role_removed',
            'description' => "Role '{$role->name}' removed from user '{$user->name}'",
        ]);

        \Cache::forget("user_permissions_{$user->id}");

        return $this->success($user->load('roles'), 'Role removed successfully');
    }

    public function syncRoles(Request $request, User $user)
    {
        $request->validate([
            'role_ids' => 'required|array',
            'role_ids.*' => 'exists:roles,id',
        ]);

        $oldRoles = $user->roles()->pluck('roles.slug')->toArray();
        
        $user->roles()->sync($request->role_ids);

        $newRoles = Role::whereIn('id', $request->role_ids)->pluck('slug')->toArray();

        AuditLog::create([
            'model_type' => User::class,
            'model_id' => $user->id,
            'changes' => ['before' => $oldRoles, 'after' => $newRoles],
            'created_by' => $request->user()->id,
            'action' => 'roles_synced',
            'description' => "Roles synced for user '{$user->name}'",
        ]);

        \Cache::forget("user_permissions_{$user->id}");

        return $this->success($user->load('roles'), 'Roles synced successfully');
    }
}