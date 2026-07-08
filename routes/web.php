<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');

// ===== Guest routes =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ===== Authenticated routes (admin + petugas) =====
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('buku', BukuController::class);
    Route::resource('anggota', AnggotaController::class);

    Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
    Route::resource('pengembalian', PengembalianController::class)->only(['index', 'create', 'store']);

    Route::get('/export/buku/excel', [ExportController::class, 'bukuExcel'])->name('export.buku.excel');
    Route::get('/export/buku/pdf', [ExportController::class, 'bukuPdf'])->name('export.buku.pdf');
    Route::get('/export/peminjaman/excel', [ExportController::class, 'peminjamanExcel'])->name('export.peminjaman.excel');
    Route::get('/export/peminjaman/pdf', [ExportController::class, 'peminjamanPdf'])->name('export.peminjaman.pdf');

    // ===== Admin-only routes =====
    Route::middleware('role:admin')->group(function () {
        Route::resource('kategori', KategoriController::class)->except(['show']);
    });
});
