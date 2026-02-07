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

Route::get('/', [AuthenticationController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthenticationController::class,'register'])->name('auth.register');
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

