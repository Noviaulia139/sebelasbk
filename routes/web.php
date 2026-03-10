<?php

use Illuminate\Support\Facades\Route;

// Import Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KonselingController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KonselingController as AdminKonselingController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;


// Landing Page
Route::get('/', function () {
    return view('home');
});


// ========================
// LOGIN
// ========================
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ========================
// SISWA
// ========================
Route::prefix('siswa')
    ->name('siswa.')
    ->group(function () {

        Route::get('/dashboard', [SiswaController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/konseling/ajukan', [KonselingController::class, 'create'])
            ->name('konseling.ajukan');

        Route::post('/konseling/store', [KonselingController::class, 'store'])
            ->name('konseling.store');

        Route::get('/riwayat', [RiwayatController::class, 'indexSiswa'])
            ->name('riwayat.index');

        Route::get('/riwayat/{id}', [RiwayatController::class, 'showSiswa'])
            ->name('riwayat.detail');

        Route::get('/profil', [SiswaController::class, 'profil'])
            ->name('profil');

        Route::post('/profil/update', [SiswaController::class, 'updateProfil'])
            ->name('profil.update');
    });

// ========================
// GURU (PAKAI AUTH)
// ========================
Route::middleware(['auth', 'role:guru'])->group(function () {

    // Dashboard
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])
        ->name('guru.dashboard');

    // Konseling Masuk (Status: Terjadwal)
    Route::get('/guru/konseling', [GuruController::class, 'index'])
        ->name('guru.konseling');
    
    Route::get('/guru/konseling/{id}', [GuruController::class, 'show'])
        ->name('guru.konseling.show');
    
    Route::post('/guru/konseling/{id}/solusi', [GuruController::class, 'solusi'])
        ->name('guru.konseling.solusi');

    // Riwayat (Status: Selesai & Batal)
    Route::get('/guru/riwayat', [GuruController::class, 'riwayat'])
        ->name('guru.riwayat');
    
    // ✅ ROUTE BARU - Detail riwayat dengan form catatan
    Route::get('/guru/riwayat/{id}', [GuruController::class, 'showRiwayat'])
        ->name('guru.riwayat.show');
    
    // ✅ ROUTE BARU - Simpan/update catatan riwayat
    Route::post('/guru/riwayat/{id}/catatan', [GuruController::class, 'storeCatatan'])
        ->name('guru.riwayat.catatan');

    // Profil
    Route::get('/guru/profil', [GuruController::class, 'profil'])
        ->name('guru.profil');
    
    Route::post('/guru/profil/update', [GuruController::class, 'updateProfil'])
        ->name('guru.profil.update');
});


// ========================
// ADMIN
// ========================
Route::middleware(['auth', 'role:admin'])->group(function () {

    // DASHBOARD
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // ======================
    // KONSELING (READ ONLY)
    // ======================
    Route::get('/admin/konseling', [AdminKonselingController::class, 'index'])
        ->name('admin.konseling.index');

    Route::get('/admin/konseling/{id}', [AdminKonselingController::class, 'show'])
        ->name('admin.konseling.show');

    // ======================
    // CRUD SISWA
    // ======================
    Route::get('/admin/siswa', [AdminSiswaController::class, 'index'])
        ->name('admin.siswa.index');

    Route::get('/admin/siswa/create', [AdminSiswaController::class, 'create'])
        ->name('admin.siswa.create');

    Route::post('/admin/siswa', [AdminSiswaController::class, 'store'])
        ->name('admin.siswa.store');

    Route::get('/admin/siswa/{id}/edit', [AdminSiswaController::class, 'edit'])
        ->name('admin.siswa.edit');

    Route::put('/admin/siswa/{id}', [AdminSiswaController::class, 'update'])
        ->name('admin.siswa.update');

    Route::delete('/admin/siswa/{id}', [AdminSiswaController::class, 'destroy'])
        ->name('admin.siswa.destroy');

    // ======================
    // CRUD GURU
    // ======================
    Route::get('/admin/guru', [AdminGuruController::class, 'index'])
        ->name('admin.guru.index');

    Route::get('/admin/guru/create', [AdminGuruController::class, 'create'])
        ->name('admin.guru.create');

    Route::post('/admin/guru', [AdminGuruController::class, 'store'])
        ->name('admin.guru.store');

    Route::get('/admin/guru/{id}/edit', [AdminGuruController::class, 'edit'])
        ->name('admin.guru.edit');

    Route::put('/admin/guru/{id}', [AdminGuruController::class, 'update'])
        ->name('admin.guru.update');

    Route::delete('/admin/guru/{id}', [AdminGuruController::class, 'destroy'])
        ->name('admin.guru.destroy');
});