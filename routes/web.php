<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'landing'])->name('landing');

Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('logged_in')->group(function () {
    Route::get('/dashboard',   [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');
    Route::get('/profile',     [PageController::class, 'profile'])->name('profile');
    Route::post('/logout',     [AuthController::class, 'logout'])->name('logout');
});