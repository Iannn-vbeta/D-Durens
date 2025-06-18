<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\ArtikelWisataController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PemesananTicketControler;
use App\Http\Controllers\ScreeningJenis;

Route::get('/',[UserDashboardController::class,'guestIndex']) ;

// Handle route kotori
Route::fallback(function () {
    if (Auth::check()) {
        return Auth::user()->role_id == 1
            ? redirect('/admin/dashboard')
            : redirect('/dashboard');
    }

    return redirect('/');
});

Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role_id == 1
            ? redirect('/admin/dashboard')
            : redirect('/dashboard');
    }
    return app(UserDashboardController::class)->guestIndex();
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'verified', 'role'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'verified',])->group(function () {
    Route::get('/akun-user', [UserController::class, 'index'])->name('admin.akunUser');
    Route::post('/akun-user', [UserController::class, 'store'])->name('akunUser.store');
    Route::put('/akun-user/{id}', [UserController::class, 'update'])->name('akunUser.update');
    Route::delete('/akun-user/{id}', [UserController::class, 'destroy'])->name('akunUser.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/akun-admin', [AdminController::class, 'index'])->name('akunAdmin.index');
    Route::post('/akun-admin', [AdminController::class, 'store'])->name('akunAdmin.store');
    Route::put('/akun-admin/{id}', [AdminController::class, 'update'])->name('akunAdmin.update');
    Route::delete('/akun-admin/{id}', [AdminController::class, 'destroy'])->name('akunAdmin.destroy');
});

Route::get('/screening', [ScreeningController::class, 'index'])->name('screening');
Route::post('/screening', [ScreeningController::class, 'store'])->name('screening.store');
Route::get('/screening-jenis', [ScreeningJenis::class, 'index'])->name('screening.jenis');
Route::post('/screening-jenis', [ScreeningJenis::class, 'store']);
Route::get('/admin/screening', [ScreeningController::class, 'indexAdmin'])->name('admin.screeningPenyakit');
Route::post('/admin/screening', [ScreeningController::class, 'store'])->name('admin.screeningPenyakit.store');
Route::get('/admin/screeningJenis', [ScreeningJenis::class, 'indexAdmin'])->name('admin.screeningJenis');
Route::post('/admin/screeningJenis', [ScreeningJenis::class, 'store'])->name('admin.screeningJenis.store');

Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/admin/artikel', [ArtikelWisataController::class, 'index'])->name('admin.artikel');
        Route::post('/admin/artikel', [ArtikelWisataController::class, 'store'])->name('artikel.store');
        Route::put('/admin/artikel/{id}', [ArtikelWisataController::class, 'update'])->name('artikel.update');
        Route::delete('/admin/artikel/{id}', [ArtikelWisataController::class, 'destroy'])->name('artikel.destroy');
});
        Route::get('/artikel/{id}', [ArtikelWisataController::class, 'showArtikel'])->name('artikel.showArtikel');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
    Route::post('/admin/inventaris', [InventarisController::class, 'store'])->name('inventaris.store');
    Route::put('/inventaris/{id}', [InventarisController::class, 'update'])->name('inventaris.update');
    Route::delete('/admin/inventaris/{id}', [InventarisController::class, 'destroy'])->name('inventaris.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('admin/pemesanantiket', [PemesananTicketControler::class, 'index'])->name('admin.pemesanan');
    Route::post('/tiket/kuota/{ticket}/tambah', [PemesananTicketControler::class, 'tambahKuota'])->name('tiket.tambahKuota');
    Route::post('/tiket/kuota/{ticket}/kurangi', [PemesananTicketControler::class, 'kurangiKuota'])->name('tiket.kurangiKuota');
    Route::put('/pemesanan/update-status/{id}', [PemesananTicketControler::class, 'updateStatus'])->name('tiket.editStatus');
    Route::get('/pemesanan/create', [PemesananTicketControler::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan/store', [PemesananTicketControler::class, 'store'])->name('pemesanan.store');
    Route::get('/pemesanan/success', [PemesananTicketControler::class, 'success'])->name('pemesanan.success');
    Route::get('/pemesanan/{username}', [PemesananTicketControler::class, 'riwayatPembelian'])->name('pemesanan.riwayatPembelian');
});

require __DIR__.'/auth.php';
require 'webSwap.php';