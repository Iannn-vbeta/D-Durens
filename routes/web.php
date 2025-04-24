<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ArtikelWisataController;


Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role_id == 1
            ? redirect('/admin/dashboard')
            : redirect('/dashboard');
    }

    return view('welcome'); // atau redirect ke /login
});

// Handle route kotor
Route::fallback(function () {
    if (Auth::check()) {
        return Auth::user()->role_id == 1
            ? redirect('/admin/dashboard')
            : redirect('/dashboard');
    }

    return redirect('/'); // Redirect to home or login
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
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'verified',])->group(function () {
    Route::get('/akun-user', [UserController::class, 'index'])->name('admin.akunUser');
    Route::post('/akun-user', [UserController::class, 'store'])->name('akunUser.store');
    Route::put('/akun-user/{id}', [UserController::class, 'update'])->name('akunUser.update');
    Route::delete('/akun-user/{id}', [UserController::class, 'destroy'])->name('akunUser.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/akun-admin', [AdminController::class, 'index'])->name('admin.akunAdmin');
    Route::post('/akun-admin', [AdminController::class, 'store'])->name('akunAdmin.store');
    Route::put('/akun-admin/{id}', [AdminController::class, 'update'])->name('akunAdmin.update');
    Route::delete('/akun-admin/{id}', [AdminController::class, 'destroy'])->name('akunAdmin.destroy');
});

Route::get('/screening', [ScreeningController::class, 'index'])->name('screening');
Route::post('/screening', [ScreeningController::class, 'store'])->name('screening.store');

Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/admin/artikel', [ArtikelWisataController::class, 'index'])->name('admin.artikel');
        Route::post('/admin/artikel', [ArtikelWisataController::class, 'store'])->name('artikel.store');
        Route::put('/admin/artikel/{id}', [ArtikelWisataController::class, 'update'])->name('artikel.update');
        Route::delete('/admin/artikel/{id}', [ArtikelWisataController::class, 'destroy'])->name('artikel.destroy');

    
});
require __DIR__.'/auth.php';
require 'webSwap.php';