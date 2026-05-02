<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $permissions = Permission::with('roles')->get();
        return $this->success($permissions);
    }

    public function show(Request $request, Permission $permission)
    {
        return $this->success($permission->load('roles'));
    }

    public function getByModule(Request $request)
    {
        $request->validate([
            'module' => 'required|string',
        ]);

        $permissions = Permission::where('slug', 'like', $request->module . '.%')
            ->get()
            ->groupBy(fn($p) => explode('.', $p->slug)[1] ?? 'other');

        return $this->success($permissions);
    }
}