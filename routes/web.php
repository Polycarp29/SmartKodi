<?php

use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\User\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticationController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthenticationController::class,'register'])->name('auth.register');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
