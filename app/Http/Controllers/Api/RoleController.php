<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\AuditLog;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        if (!$request->user()->hasRole('admin') && !$request->user()->hasRole('superadmin')) {
            return $this->error('Unauthorized. Admin role required.', 403);
        }

        $roles = Role::with('permissions')->get();
        return $this->success($roles);
    }

    public function store(RoleRequest $request)
    {
        if (!$request->user()->hasRole('admin') && !$request->user()->hasRole('superadmin')) {
            return $this->error('Unauthorized. Admin role required.', 403);
        }

        $role = DB::transaction(function () use ($request) {
            $role = Role::create($request->validated());

            AuditLog::create([
                'model_type' => Role::class,
                'model_id' => $role->id,
                'changes' => ['created' => $role->toArray()],
                'created_by' => $request->user()->id,
                'action' => 'role_created',
                'description' => 'Role created: ' . $role->name,
            ]);

            return $role;
        });

        return $this->success($role->load('permissions'), 'Role created successfully', 201);
    }

    public function show(Request $request, Role $role)
    {
        if (!$request->user()->hasRole('admin') && !$request->user()->hasRole('superadmin')) {
            return $this->error('Unauthorized. Admin role required.', 403);
        }

        return $this->success($role->load('permissions'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        if (!$request->user()->hasRole('admin') && !$request->user()->hasRole('superadmin')) {
            return $this->error('Unauthorized. Admin role required.', 403);
        }

        $oldData = $role->toArray();

        DB::transaction(function () use ($role, $request, $oldData) {
            $role->update($request->validated());

            AuditLog::create([
                'model_type' => Role::class,
                'model_id' => $role->id,
                'changes' => ['before' => $oldData, 'after' => $role->fresh()->toArray()],
                'created_by' => $request->user()->id,
                'action' => 'role_updated',
                'description' => 'Role updated: ' . $role->name,
            ]);
        });

        return $this->success($role->load('permissions'), 'Role updated successfully');
    }

    public function destroy(Request $request, Role $role)
    {
        if (!$request->user()->hasRole('admin') && !$request->user()->hasRole('superadmin')) {
            return $this->error('Unauthorized. Admin role required.', 403);
        }

        if ($role->users()->count() > 0) {
            return $this->error('Cannot delete role with assigned users.', 400);
        }

        $roleName = $role->name;

        DB::transaction(function () use ($role, $roleName, $request) {
            $role->delete();

            AuditLog::create([
                'model_type' => Role::class,
                'model_id' => $role->id,
                'changes' => ['deleted' => $roleName],
                'created_by' => $request->user()->id,
                'action' => 'role_deleted',
                'description' => 'Role deleted: ' . $roleName,
            ]);
        });

        return $this->success(null, 'Role deleted successfully');
    }
}