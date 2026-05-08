<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with(['permissions', 'users'])->get();
        $permissions = Permission::all()->groupBy(fn($p) => explode('.', $p->slug)[0]);

        return view('roles.index', compact('roles', 'permissions'));
    }

    public function show(Role $role)
    {
        $role->load(['permissions', 'users']);
        $allRoles = Role::with(['permissions', 'users'])->get();
        $allPermissions = Permission::all()->groupBy(fn($p) => explode('.', $p->slug)[0]);

        return view('roles.index', [
            'role' => $role, 
            'roles' => $allRoles, 
            'permissions' => $allPermissions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('roles')->with('success', 'Role created successfully');
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('roles')->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return redirect()->route('roles')->with('error', 'Cannot delete role with assigned users');
        }

        $role->delete();

        return redirect()->route('roles')->with('success', 'Role deleted successfully');
    }
}