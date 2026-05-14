<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Web\CommunicationController;
use App\Http\Controllers\Web\TaskController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\ProjectController;
use App\Http\Controllers\Web\TeamController;
use App\Http\Controllers\Web\AnalyticsController;
use App\Http\Controllers\Web\ReportController;
use App\Http\Controllers\Web\BillingController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'loginWeb'])->name('login.submit');

Route::get('/signup/{code}', [ClientController::class, 'showSignup'])->name('signup.show');
Route::post('/signup/{code}', [ClientController::class, 'processSignup'])->name('signup.process');

Route::middleware('auth')->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'clientDashboard'])->name('client.dashboard');

    Route::middleware('role:admin,superadmin')->group(function () {
        Route::get('/clients', [ClientController::class, 'index'])->name('clients');
        Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
        Route::post('/clients/invite', [ClientController::class, 'generateInvite'])->name('clients.invite');
        Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
        Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
        Route::post('/clients/{id}/documents', [ClientController::class, 'uploadDocument'])->name('clients.uploadDocument');
        Route::get('/clients/activity', [ClientController::class, 'allActivity'])->name('clients.activity.all');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/files', [FileController::class, 'index'])->name('files');
        Route::post('/files', [FileController::class, 'store'])->name('files.store');
        Route::post('/files/{id}/share', [FileController::class, 'shareFile'])->name('files.share.create');
        Route::delete('/files/{id}/share', [FileController::class, 'disableShare'])->name('files.share.disable');
        Route::delete('/files/{id}', [FileController::class, 'destroy'])->name('files.destroy');
        Route::get('/files/share/{hash}', [FileController::class, 'viewShared'])->name('files.share.view');
        Route::post('/files/share/{hash}/verify', [FileController::class, 'verifyPassword'])->name('files.share.verify');
        Route::get('/files/share/{hash}/download', [FileController::class, 'downloadShared'])->name('files.share.download');
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
        Route::get('/notifications/{notification}', [NotificationController::class, 'details'])->name('notifications.details');
        Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
        Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
        Route::put('/settings/preferences', [SettingsController::class, 'updatePreferences'])->name('settings.preferences');
        Route::post('/settings/session/{sessionId}', [SettingsController::class, 'logoutSession'])->name('settings.logoutSession');
        Route::post('/settings/purge-cache', [SettingsController::class, 'purgeCache'])->name('settings.purgeCache');
        Route::get('/settings/export', [SettingsController::class, 'exportData'])->name('settings.export');
        Route::post('/settings/export', [SettingsController::class, 'exportData'])->name('settings.exportPost');
        Route::post('/settings/delete-account', [SettingsController::class, 'deleteAccount'])->name('settings.deleteAccount');
        Route::post('/settings/toggle-chat-channel', [SettingsController::class, 'toggleChatChannel'])->name('settings.toggleChatChannel');
        Route::post('/settings/notification-setting', [SettingsController::class, 'updateNotificationSetting'])->name('settings.notificationSetting');
        Route::post('/settings/quiet-hours', [SettingsController::class, 'updateQuietHours'])->name('settings.quietHours');
        Route::post('/settings/auth-rule', [SettingsController::class, 'updateAuthRule'])->name('settings.authRule');

        Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
        Route::get('/activity/sessions', [ActivityController::class, 'sessions'])->name('activity.sessions');
        Route::get('/activity/security', [ActivityController::class, 'security'])->name('activity.security');
        Route::get('/activity/export', [ActivityController::class, 'exportCsv'])->name('activity.export');
        Route::get('/activity/charts', [ActivityController::class, 'charts'])->name('activity.charts');
        Route::delete('/sessions/{id}/logout', [ActivityController::class, 'forceLogout'])->name('sessions.forceLogout');
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'password'])->name('profile.password');

    // Communication
    Route::get('/communication', [CommunicationController::class, 'index'])->name('communication');
    Route::get('/communication/{chat}', [CommunicationController::class, 'chat'])->name('communication.chat');
    Route::post('/communication', [CommunicationController::class, 'store'])->name('communication.store');

    // Tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::get('/tasks/search', [TaskController::class, 'search'])->name('tasks.search');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    // Team
    Route::get('/team', [TeamController::class, 'index'])->name('team');
    Route::get('/team/assign', [TeamController::class, 'assign'])->name('team.assign');

    // Analytics
    Route::get('/analytics/executive', [AnalyticsController::class, 'executive'])->name('analytics.executive');
    Route::get('/analytics/marketing', [AnalyticsController::class, 'marketing'])->name('analytics.marketing');
    Route::get('/analytics/operations', [AnalyticsController::class, 'operations'])->name('analytics.operations');

    // Reports
    Route::get('/reports/insights', [ReportController::class, 'insights'])->name('reports.insights');
    Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
    Route::get('/reports/financial', [ReportController::class, 'financial'])->name('reports.financial');
    Route::get('/reports/support', [ReportController::class, 'support'])->name('reports.support');
    Route::get('/reports/builder', [ReportController::class, 'builder'])->name('reports.builder');
    Route::get('/reports/saved', [ReportController::class, 'saved'])->name('reports.saved');

    // Billing
    Route::get('/billing', [BillingController::class, 'index'])->name('billing');
    Route::get('/billing/invoices', [BillingController::class, 'invoices'])->name('billing.invoices');
    Route::get('/billing/invoices/{invoice}', [BillingController::class, 'invoiceDetails'])->name('billing.invoice.details');
    Route::get('/billing/transactions', [BillingController::class, 'transactions'])->name('billing.transactions');

    // Project Sub-pages
    Route::get('/projects/hub', [ProjectController::class, 'hub'])->name('projects.hub');
    Route::get('/projects/assigned', [ProjectController::class, 'assigned'])->name('projects.assigned');
    Route::get('/projects/my-assigned', [ProjectController::class, 'myAssigned'])->name('projects.my-assigned');
    Route::get('/projects/team', [ProjectController::class, 'team'])->name('projects.team');
    Route::get('/projects/overview', [ProjectController::class, 'overview'])->name('projects.overview');
    Route::get('/projects/timeline', [ProjectController::class, 'timeline'])->name('projects.timeline');
    Route::get('/projects/tasks-workspace', [ProjectController::class, 'tasksWorkspace'])->name('projects.tasks-workspace');
    Route::get('/projects/files-workspace', [ProjectController::class, 'filesWorkspace'])->name('projects.files-workspace');

    // Task Sub-pages
    Route::get('/tasks/hub', [TaskController::class, 'hub'])->name('tasks.hub');
    Route::get('/tasks/calendar', [TaskController::class, 'calendar'])->name('tasks.calendar');
    Route::get('/tasks/analytics', [TaskController::class, 'analytics'])->name('tasks.analytics');
    Route::get('/tasks/assign', [TaskController::class, 'assign'])->name('tasks.assign');
    Route::get('/tasks/manage', [TaskController::class, 'manage'])->name('tasks.manage');

    // Communication Sub-pages
    Route::get('/communication/monitor', [CommunicationController::class, 'monitor'])->name('communication.monitor');
    Route::get('/communication/control', [CommunicationController::class, 'control'])->name('communication.control');
    Route::get('/communication/create', [CommunicationController::class, 'create'])->name('communication.create');

    // Activity Sub-pages
    Route::get('/activity/admin', [ActivityController::class, 'admin'])->name('activity.admin');
});

Route::post('/settings/toggle-2fa', [SettingsController::class, 'toggle2FA'])->name('settings.toggle2fa');

Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout');
