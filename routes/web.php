<?php

use App\Http\Controllers\User\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticationController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthenticationController::class,'register'])->name('auth.register');
