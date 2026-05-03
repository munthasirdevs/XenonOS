<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;

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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/notifications/{notification}', [NotificationController::class, 'details'])->name('notifications.details');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'password'])->name('profile.password');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
});

Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout');
