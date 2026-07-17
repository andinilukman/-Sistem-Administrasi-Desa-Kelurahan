<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\AparatDesaController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\VerifikasiSuratController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\InventarisAsetController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\KelolaPenggunaController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    
    // Semua role bisa melihat pengumuman
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/pengumuman/{pengumuman}', [PengumumanController::class, 'show'])->name('pengumuman.show');

    // Warga Routes
    Route::middleware(['role:Warga'])->group(function () {
        Route::get('/pengajuan-surat/warga', [PengajuanSuratController::class, 'wargaIndex'])->name('pengajuan-surat.warga');
        Route::get('/pengajuan-surat/warga/create', [PengajuanSuratController::class, 'create'])->name('pengajuan-surat.create-warga');
        Route::post('/pengajuan-surat/warga', [PengajuanSuratController::class, 'store'])->name('pengajuan-surat.store-warga');
        Route::get('/pengajuan-surat/warga/{id}', [PengajuanSuratController::class, 'show'])->name('pengajuan-surat.show-warga');
        
        Route::resource('pengaduan', PengaduanController::class)->except(['destroy']);
    });

    // Admin & Kepala Desa Routes
    Route::middleware(['role:Admin,Kepala Desa'])->group(function () {
        Route::resource('verifikasi-surat', VerifikasiSuratController::class)->except(['create', 'store', 'destroy']);
        
        Route::get('/laporan/penduduk', [LaporanController::class, 'penduduk'])->name('laporan-penduduk.index');
        Route::get('/laporan/kartu-keluarga', [LaporanController::class, 'kartuKeluarga'])->name('laporan-kartu-keluarga.index');
        Route::get('/laporan/pengajuan-surat', [LaporanController::class, 'pengajuanSurat'])->name('laporan-surat.index');
        Route::get('/statistik', [DashboardController::class, 'placeholder'])->defaults('title', 'statistik')->name('statistik');
    });

    // Admin Only Routes
    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('kartu-keluarga', KartuKeluargaController::class);
        Route::resource('penduduk', PendudukController::class);
        Route::resource('aparat-desa', AparatDesaController::class);
        Route::resource('pengajuan-surat', PengajuanSuratController::class);
        
        Route::resource('pengumuman', PengumumanController::class)->except(['index', 'show']);
        Route::resource('inventaris-aset', InventarisAsetController::class);
        Route::resource('kelola-pengguna', KelolaPenggunaController::class);
        
        // Admin update status pengaduan
        Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    });
});
