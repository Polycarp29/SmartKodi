<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\ProfilePage;
use App\Http\Controllers\Pages\Notifications;
use App\Http\Controllers\Pages\AIRecommendations;
use App\Http\Controllers\Pages\SettingsController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\PropertiesController;
use App\Http\Controllers\Pages\TenantsController;
use App\Http\Controllers\Pages\UnitsController;
use App\Http\Controllers\Pages\FinancialsController;
use App\Http\Controllers\User\Auth\AuthenticationController;
use App\Http\Controllers\Pages\UtilitiesController;
use App\Http\Controllers\Pages\MaintenanceController;
use App\Http\Controllers\Pages\ReportsController;

Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/', 'login')->name('auth.login');
    Route::post('/login', 'handleLogin')->name('auth.login.post');
    Route::get('/register', 'register')->name('auth.register');
    Route::post('/register', 'handleRegister')->name('auth.register.post');
    Route::post('/logout', 'logout')->name('auth.logout');

    Route::get('/verify-otp', 'showVerifyOtp')->name('auth.verify-otp');
    Route::post('/verify-otp', 'handleVerifyOtp')->name('auth.verify-otp.post');
    Route::post('/resend-otp', 'resendOtp')->name('auth.resend-otp');

    Route::get('/forgot-password', 'showForgotPassword')->name('auth.forgot-password');
    Route::post('/forgot-password', 'handleForgotPassword')->name('auth.forgot-password.post');
    Route::get('/reset-password/{token}', 'showResetPassword')->name('auth.reset-password');
    Route::post('/reset-password', 'handleResetPassword')->name('auth.reset-password.post');
});

// Authentication Middleware

Route::middleware('auth')->group(function () {
    Route::middleware('email.isverified')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfilePage::class, 'index'])->name('profile.page');
        Route::get('/notifications', [Notifications::class, 'viewNotifications'])->name('notifications');
        Route::get('/ai-recommendations', [AIRecommendations::class, 'index'])->name('ai');
        Route::get('/properties', [PropertiesController::class, 'index'])->name('properties');
        Route::get('/tenants', [TenantsController::class, 'index'])->name('tenants');
        Route::get('/units', [UnitsController::class, 'index'])->name('units');

        Route::prefix('financials')->group(function () {
            Route::get('/rent-payments', [FinancialsController::class, 'rentPayments'])->name('financials.payments');
            Route::get('/expenses', [FinancialsController::class, 'expenses'])->name('financials.expenses');
            Route::get('/invoices', [FinancialsController::class, 'invoices'])->name('financials.invoices');
        });

        Route::get('/settings', [SettingsController::class, 'index'])->name('view.settings');
        Route::prefix('settings')->group(function () {
            Route::get('/subscriptions', [SettingsController::class, 'subscriptions'])->name('settings.subscriptions');
            Route::get('/ai', [SettingsController::class, 'aiSettings'])->name('settings.ai');
            Route::get('/sms', [SettingsController::class, 'smsSettings'])->name('settings.sms');
            Route::get('/roles', [SettingsController::class, 'rolesPermissions'])->name('settings.roles');
            Route::get('/security', [SettingsController::class, 'security2fa'])->name('settings.security');
            Route::get('/properties', [SettingsController::class, 'propertySettings'])->name('settings.properties');
        });

        Route::prefix('utilities')->group(function () {
            Route::get('/water', [UtilitiesController::class, 'water'])->name('utilities.water');
            Route::get('/electricity', [UtilitiesController::class, 'electricity'])->name('utilities.electricity');
            Route::get('/gas', [UtilitiesController::class, 'gas'])->name('utilities.gas');
        });

        // Maintenance Route
        Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');

        // Reports Route
        Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    });
});
