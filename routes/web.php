<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'process'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Both Admin and Kepala Desa can access Dashboard, Surat, Laporan, Profil
    Route::middleware('role:Admin,Kepala Desa')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Administrasi Surat
        Route::resource('pengajuan-surat', App\Http\Controllers\PengajuanSuratController::class);
        Route::resource('verifikasi-surat', App\Http\Controllers\VerifikasiSuratController::class)->except(['create', 'store', 'destroy']);
        Route::get('/surat-disetujui', [DashboardController::class, 'placeholder'])->defaults('title', 'surat-disetujui')->name('surat-disetujui');
        Route::get('/surat-ditolak', [DashboardController::class, 'placeholder'])->defaults('title', 'surat-ditolak')->name('surat-ditolak');
        Route::get('/riwayat-surat', [DashboardController::class, 'placeholder'])->defaults('title', 'riwayat-surat')->name('riwayat-surat');
        
        // Laporan
        Route::get('/laporan-penduduk', [DashboardController::class, 'placeholder'])->defaults('title', 'laporan-penduduk')->name('laporan-penduduk');
        Route::get('/laporan-surat', [DashboardController::class, 'placeholder'])->defaults('title', 'laporan-surat')->name('laporan-surat');
        Route::get('/statistik', [DashboardController::class, 'placeholder'])->defaults('title', 'statistik')->name('statistik');
        
        // Profil
        Route::get('/profil', [DashboardController::class, 'placeholder'])->defaults('title', 'profil')->name('profil');
    });

    // Only Admin can access Master Data
    Route::middleware('role:Admin')->group(function () {
        Route::resource('kartu-keluarga', App\Http\Controllers\KartuKeluargaController::class);
        Route::resource('penduduk', App\Http\Controllers\PendudukController::class);
        Route::resource('aparat-desa', App\Http\Controllers\AparatDesaController::class);
    });
});

// Catch-all route to prevent 404 and redirect to dashboard if auth, else login
Route::fallback(function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});
