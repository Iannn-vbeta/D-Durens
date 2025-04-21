<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\ScanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ScreeningController;



Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role_id == 1
            ? redirect('/admin/dashboard')
            : redirect('/dashboard');
    }

    return view('welcome'); // atau redirect ke /login
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Semua yang login
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::get('/akun-user', [UserController::class, 'index'])->name('admin.akunUser');
Route::post('/akun-user', [UserController::class, 'store'])->name('akunUser.store');
Route::put('/akun-user/{id}', [UserController::class, 'update'])->name('akunUser.update');
Route::delete('/akun-user/{id}', [UserController::class, 'destroy'])->name('akunUser.destroy');

Route::get('/screening', [ScreeningController::class, 'index']);
Route::post('/screening', [ScreeningController::class, 'upload']);

require __DIR__.'/auth.php';
require 'webSwap.php';