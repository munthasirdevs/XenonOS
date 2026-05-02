<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\UserRoleController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\RolePermissionController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\BillingController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\ApiKeyController;
use App\Http\Controllers\Api\SystemController;
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

// Project routes
Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index']);
    Route::post('/', [ProjectController::class, 'store'])->middleware('permission:project.create');
    Route::get('/{project}', [ProjectController::class, 'show']);
    Route::put('/{project}', [ProjectController::class, 'update'])->middleware('permission:project.update');
    Route::delete('/{project}', [ProjectController::class, 'destroy'])->middleware('permission:project.delete');
    
    Route::get('/{project}/users', [ProjectController::class, 'users']);
    Route::post('/{project}/users', [ProjectController::class, 'assignUsers'])->middleware('permission:project.assign');
    Route::delete('/{project}/users/{user}', [ProjectController::class, 'removeUser'])->middleware('permission:project.assign');
    
    Route::get('/{project}/timeline', [ProjectController::class, 'timeline']);
    Route::post('/{project}/timeline', [ProjectController::class, 'addTimeline']);
    
    Route::get('/{project}/files', [ProjectController::class, 'files']);
    Route::post('/{project}/files', [ProjectController::class, 'linkFile']);
    Route::get('/{project}/workspace', [ProjectController::class, 'workspace']);
});

// Task routes
Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('/', [TaskController::class, 'store'])->middleware('permission:task.create');
    Route::get('/{task}', [TaskController::class, 'show']);
    Route::put('/{task}', [TaskController::class, 'update'])->middleware('permission:task.update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->middleware('permission:task.delete');
    
    Route::post('/{task}/status', [TaskController::class, 'updateStatus']);
    Route::post('/{task}/assign', [TaskController::class, 'assign']);
    Route::get('/{task}/logs', [TaskController::class, 'logs']);
    Route::get('/analytics', [TaskController::class, 'analytics']);
    Route::get('/calendar', [TaskController::class, 'calendar']);
    Route::post('/{task}/reschedule', [TaskController::class, 'reschedule']);
});

// Chat routes
Route::prefix('chats')->group(function () {
    Route::get('/', [ChatController::class, 'index']);
    Route::post('/', [ChatController::class, 'store']);
    Route::get('/{chat}', [ChatController::class, 'show']);
    Route::delete('/{chat}', [ChatController::class, 'destroy']);
    Route::get('/{chat}/messages', [ChatController::class, 'messages']);
    Route::post('/{chat}/messages', [ChatController::class, 'sendMessage']);
    Route::delete('/{chat}/messages/{message}', [ChatController::class, 'deleteMessage']);
    Route::post('/{chat}/messages/{message}/flag', [ChatController::class, 'flagMessage']);
    Route::post('/{chat}/mute/{user}', [ChatController::class, 'muteUser']);
    Route::delete('/{chat}/mute/{user}', [ChatController::class, 'unmuteUser']);
    Route::get('/{chat}/muted', [ChatController::class, 'mutedUsers']);
});

// Announcement routes
Route::prefix('announcements')->group(function () {
    Route::get('/', [AnnouncementController::class, 'index']);
    Route::post('/', [AnnouncementController::class, 'store'])->middleware('permission:announcement.create');
    Route::get('/{announcement}', [AnnouncementController::class, 'show']);
    Route::put('/{announcement}', [AnnouncementController::class, 'update'])->middleware('permission:announcement.create');
    Route::delete('/{announcement}', [AnnouncementController::class, 'destroy']);
});

// Note routes
Route::prefix('notes')->group(function () {
    Route::get('/', [NoteController::class, 'index']);
    Route::post('/', [NoteController::class, 'store']);
    Route::get('/{note}', [NoteController::class, 'show']);
    Route::put('/{note}', [NoteController::class, 'update']);
    Route::delete('/{note}', [NoteController::class, 'destroy']);
});

// File routes
Route::prefix('files')->group(function () {
    Route::get('/', [FileController::class, 'index']);
    Route::post('/', [FileController::class, 'store'])->middleware('permission:file.upload');
    Route::get('/{file}', [FileController::class, 'show']);
    Route::delete('/{file}', [FileController::class, 'destroy'])->middleware('permission:file.delete');
    Route::get('/{file}/download', [FileController::class, 'download']);

    // File advanced routes
    Route::get('/categories', [FileController::class, 'categories']);
    Route::post('/categories', [FileController::class, 'storeCategory']);
    Route::post('/{file}/category', [FileController::class, 'assignCategory']);
    Route::post('/{file}/tags', [FileController::class, 'addTag']);
    Route::delete('/{file}/tags', [FileController::class, 'removeTag']);
    Route::get('/search', [FileController::class, 'search']);
});

// Invoice routes
Route::prefix('invoices')->group(function () {
    Route::get('/', [InvoiceController::class, 'index']);
    Route::post('/', [InvoiceController::class, 'store']);
    Route::get('/{invoice}', [InvoiceController::class, 'show']);
    Route::put('/{invoice}', [InvoiceController::class, 'update']);
    Route::post('/{invoice}/send', [InvoiceController::class, 'send']);
    Route::post('/{invoice}/paid', [InvoiceController::class, 'markPaid']);
    Route::post('/{invoice}/cancel', [InvoiceController::class, 'cancel']);
});

// Payment routes
Route::prefix('payments')->group(function () {
    Route::get('/', [PaymentController::class, 'index']);
    Route::post('/', [PaymentController::class, 'store']);
    Route::get('/{payment}', [PaymentController::class, 'show']);
    Route::post('/{payment}/refund', [PaymentController::class, 'refund']);
});
Route::get('/payments/stats', [PaymentController::class, 'methodStats']);

// Billing reports routes
Route::get('/billing/dashboard', [BillingController::class, 'dashboard']);
Route::get('/billing/revenue', [BillingController::class, 'revenueChart']);
Route::get('/billing/invoices/status', [BillingController::class, 'invoiceStatus']);
Route::get('/billing/clients/revenue', [BillingController::class, 'clientRevenue']);
Route::get('/billing/invoices/overdue', [BillingController::class, 'overdueInvoices']);
Route::get('/billing/aging', [BillingController::class, 'agingReport']);
Route::get('/billing/export', [BillingController::class, 'export']);

// Notification routes
Route::prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index']);
    Route::get('/unread', [NotificationController::class, 'unread']);
    Route::get('/unread/count', [NotificationController::class, 'unreadCount']);
    Route::post('/{notification}/read', [NotificationController::class, 'markRead']);
    Route::post('/read-all', [NotificationController::class, 'markAllRead']);
    Route::delete('/{notification}', [NotificationController::class, 'destroy']);
    Route::delete('/', [NotificationController::class, 'clear']);
});
Route::post('/notifications/send', [NotificationController::class, 'send']);

// Report routes
Route::get('/reports/dashboard', [ReportController::class, 'dashboard']);
Route::get('/reports/activities', [ReportController::class, 'activities']);
Route::get('/reports/user/activity', [ReportController::class, 'userActivity']);
Route::get('/reports/tasks', [ReportController::class, 'taskStats']);
Route::get('/reports/projects', [ReportController::class, 'projectStats']);
Route::get('/reports/clients', [ReportController::class, 'clientStats']);
Route::get('/reports/export', [ReportController::class, 'export']);

// Settings routes
Route::prefix('settings')->group(function () {
    Route::get('/', [SettingsController::class, 'index']);
    Route::get('/{setting}', [SettingsController::class, 'show']);
    Route::post('/', [SettingsController::class, 'store']);
    Route::put('/{setting}', [SettingsController::class, 'update']);
    Route::delete('/{setting}', [SettingsController::class, 'destroy']);
    Route::get('/group/{group}', [SettingsController::class, 'byGroup']);
    Route::get('/value', [SettingsController::class, 'getValue']);
    Route::post('/value', [SettingsController::class, 'setValue']);
});

// API Keys routes
Route::prefix('api-keys')->group(function () {
    Route::get('/', [ApiKeyController::class, 'index']);
    Route::post('/', [ApiKeyController::class, 'store']);
    Route::get('/{apiKey}', [ApiKeyController::class, 'show']);
    Route::put('/{apiKey}', [ApiKeyController::class, 'update']);
    Route::delete('/{apiKey}', [ApiKeyController::class, 'destroy']);
    Route::post('/{apiKey}/regenerate', [ApiKeyController::class, 'regenerate']);
});

// System routes
Route::get('/system/health', [SystemController::class, 'health']);
Route::get('/system/stats', [SystemController::class, 'stats']);
Route::get('/system/info', [SystemController::class, 'info']);
Route::get('/system/routes', [SystemController::class, 'routes']);
Route::get('/system/services', [SystemController::class, 'services']);