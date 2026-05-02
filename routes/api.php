<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserRoleController;
use App\Http\Controllers\Api\RolePermissionController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar']);
    
    Route::get('/sessions', [SessionController::class, 'index']);
    Route::delete('/sessions/{session}', [SessionController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::post('/', [RoleController::class, 'store'])->middleware('permission:role.create');
        Route::get('/{role}', [RoleController::class, 'show']);
        Route::put('/{role}', [RoleController::class, 'update'])->middleware('permission:role.update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->middleware('permission:role.delete');
        
        Route::get('/{role}/permissions', [RolePermissionController::class, 'index']);
        Route::post('/{role}/permissions', [RolePermissionController::class, 'assignPermission'])
            ->middleware('permission:role.update');
        Route::put('/{role}/permissions', [RolePermissionController::class, 'syncPermissions'])
            ->middleware('permission:role.update');
        Route::delete('/{role}/permissions/{permission}', [RolePermissionController::class, 'removePermission'])
            ->middleware('permission:role.update');
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index']);
        Route::get('/{permission}', [PermissionController::class, 'show']);
        Route::get('/module/list', [PermissionController::class, 'getByModule']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/{user}/roles', [UserRoleController::class, 'index']);
        Route::post('/{user}/roles', [UserRoleController::class, 'assignRole'])
            ->middleware('permission:role.update');
        Route::delete('/{user}/roles/{role}', [UserRoleController::class, 'removeRole'])
            ->middleware('permission:role.update');
        Route::put('/{user}/roles', [UserRoleController::class, 'syncRoles'])
            ->middleware('permission:role.update');
    });
});

Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::post('/', [ClientController::class, 'store'])->middleware('permission:client.create');
    Route::get('/{client}', [ClientController::class, 'show']);
    Route::put('/{client}', [ClientController::class, 'update'])->middleware('permission:client.update');
    Route::delete('/{client}', [ClientController::class, 'destroy'])->middleware('permission:client.delete');
    
    Route::get('/{client}/activities', [ClientController::class, 'activities']);
    Route::get('/{client}/documents', [ClientController::class, 'documents']);
    Route::get('/{client}/sessions', [ClientController::class, 'sessions']);
});