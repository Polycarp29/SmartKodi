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


Route::prefix('/defaults')->group(function(){
    Route::get('/login', function(){
        return redirect()->route('auth.login');
    })->name('login');
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/', 'login')->name('auth.login');
    Route::post('/login', 'handleLogin')->name('auth.login.post');
    Route::get('/register', 'register')->name('auth.register');
    Route::post('/register', 'handleRegister')->name('auth.register.post');
    Route::post('/logout', 'logout')->name('auth.logout');

    Route::get('/forgot-password', 'showForgotPassword')->name('auth.forgot-password');
    Route::post('/forgot-password', 'handleForgotPassword')->name('auth.forgot-password.post');
    Route::get('/reset-password/{token}', 'showResetPassword')->name('auth.reset-password');
    Route::post('/reset-password', 'handleResetPassword')->name('auth.reset-password.post');
});

// Authentication Middleware

Route::middleware('auth')->group(function () {

    // OTP Verification
    Route::prefix('verify-otp')->name('auth.')->group(function () {
        Route::get('/', [AuthenticationController::class, 'showVerifyOtp'])->name('verify-otp');
        Route::post('/', [AuthenticationController::class, 'handleVerifyOtp'])->name('verify-otp.post');
        Route::post('/resend', [AuthenticationController::class, 'resendOtp'])->name('resend-otp');
    });

    // Protected Routes (verified users only)
    Route::middleware('email.isverified')->group(function () {

        // Dashboard & Core Pages
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfilePage::class, 'index'])->name('profile.page');
        Route::get('/notifications', [Notifications::class, 'viewNotifications'])->name('notifications');
        Route::get('/ai-recommendations', [AIRecommendations::class, 'index'])->name('ai');
        Route::get('/properties', [PropertiesController::class, 'index'])->name('properties');
        Route::get('/tenants', [TenantsController::class, 'index'])->name('tenants');
        Route::get('/units', [UnitsController::class, 'index'])->name('units');

        // Financials
        Route::prefix('financials')->name('financials.')->group(function () {
            Route::get('/rent-payments', [FinancialsController::class, 'rentPayments'])->name('payments');
            Route::get('/expenses', [FinancialsController::class, 'expenses'])->name('expenses');
            Route::get('/invoices', [FinancialsController::class, 'invoices'])->name('invoices');
        });

        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [SettingsController::class, 'index'])->name('index');
            Route::get('/subscriptions', [SettingsController::class, 'subscriptions'])->name('subscriptions');
            Route::get('/ai', [SettingsController::class, 'aiSettings'])->name('ai');
            Route::get('/sms', [SettingsController::class, 'smsSettings'])->name('sms');
            Route::get('/roles', [SettingsController::class, 'rolesPermissions'])->name('roles');
            Route::get('/security', [SettingsController::class, 'security2fa'])->name('security');
            Route::get('/properties', [SettingsController::class, 'propertySettings'])->name('properties');
        });

        // Utilities
        Route::prefix('utilities')->name('utilities.')->group(function () {
            Route::get('/water', [UtilitiesController::class, 'water'])->name('water');
            Route::get('/electricity', [UtilitiesController::class, 'electricity'])->name('electricity');
            Route::get('/gas', [UtilitiesController::class, 'gas'])->name('gas');
        });

        // Maintenance & Reports
        Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
        Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    });
});
