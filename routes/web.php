<?php

use App\Http\Controllers\Pages\AIRecommendations;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\ProfilePage;
use App\Http\Controllers\Pages\Notifications;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\PropertiesController;
use App\Http\Controllers\User\Auth\AuthenticationController;

Route::get('/', [AuthenticationController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthenticationController::class,'register'])->name('auth.register');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [ProfilePage::class, 'index'])->name('profile.page');
Route::get('/notifications', [Notifications::class, 'viewNotifications'])->name('notifications');
Route::get('/ai-recommendations', [AIRecommendations::class, 'index'])->name('ai');
Route::get('/properties', [PropertiesController::class, 'index'])->name('properties');

