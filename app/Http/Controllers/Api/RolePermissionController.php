<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    use ApiResponse;

    public function index(Request $request, Role $role)
    {
        return $this->success($role->load('permissions'));
    }

    public function assignPermission(Request $request, Role $role)
    {
        $request->validate([
            'permission_id' => 'required|exists:permissions,id',
        ]);

        $permission = Permission::findOrFail($request->permission_id);

        if ($role->hasPermission($permission->slug)) {
            return $this->error('Role already has this permission.', 400);
        }

        $oldPermissions = $role->permissions()->pluck('permissions.slug')->toArray();
        
        $role->permissions()->attach($permission->id);

        AuditLog::create([
            'model_type' => Role::class,
            'model_id' => $role->id,
            'changes' => [
                'before' => $oldPermissions,
                'after' => array_merge($oldPermissions, [$permission->slug])
            ],
            'created_by' => $request->user()->id,
            'action' => 'permission_assigned',
            'description' => "Permission '{$permission->name}' assigned to role '{$role->name}'",
        ]);

        return $this->success($role->load('permissions'), 'Permission assigned successfully');
    }

    public function removePermission(Request $request, Role $role, Permission $permission)
    {
        if (!$role->hasPermission($permission->slug)) {
            return $this->error('Role does not have this permission.', 400);
        }

        $oldPermissions = $role->permissions()->pluck('permissions.slug')->toArray();
        
        $role->permissions()->detach($permission->id);

        AuditLog::create([
            'model_type' => Role::class,
            'model_id' => $role->id,
            'changes' => [
                'before' => $oldPermissions,
                'after' => array_diff($oldPermissions, [$permission->slug])
            ],
            'created_by' => $request->user()->id,
            'action' => 'permission_removed',
            'description' => "Permission '{$permission->name}' removed from role '{$role->name}'",
        ]);

        return $this->success($role->load('permissions'), 'Permission removed successfully');
    }

    public function syncPermissions(Request $request, Role $role)
    {
        $request->validate([
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id',
        ]);

        $oldPermissions = $role->permissions()->pluck('permissions.slug')->toArray();
        
        $role->permissions()->sync($request->permission_ids);

        $newPermissions = Permission::whereIn('id', $request->permission_ids)->pluck('slug')->toArray();

        AuditLog::create([
            'model_type' => Role::class,
            'model_id' => $role->id,
            'changes' => ['before' => $oldPermissions, 'after' => $newPermissions],
            'created_by' => $request->user()->id,
            'action' => 'permissions_synced',
            'description' => "Permissions synced for role '{$role->name}'",
        ]);

        return $this->success($role->load('permissions'), 'Permissions synced successfully');
    }
}