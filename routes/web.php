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
});

Route::post('/settings/toggle-2fa', [SettingsController::class, 'toggle2FA'])->name('settings.toggle2fa');

Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout');
