<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;
use App\Http\Controllers\Prodi\DashboardController as ProdiDashboard;
use App\Http\Controllers\Puskaka\DashboardController as PuskakaDashboard;

/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/', [GuestController::class, 'index'])->name('guest.home');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    Route::get('/faq', [GuestController::class, 'faq'])->name('guest.faq');
    Route::get('/pengumuman', [GuestController::class, 'announcements'])->name('guest.announcements');
    Route::get('/program-beasiswa', [GuestController::class, 'scholarshipPrograms'])->name('guest.programs');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD ROUTES (ROLE BASED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    Route::prefix('dashboard/admin')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard.admin');
        Route::get('/accounts', [AdminDashboard::class, 'accounts'])->name('admin.accounts');
        Route::get('/verification', [AdminDashboard::class, 'verification'])->name('admin.verification');
        Route::get('/monitoring', [AdminDashboard::class, 'monitoring'])->name('admin.monitoring');
    });


    /*
    |--------------------------------------------------------------------------
    | MAHASISWA
    |--------------------------------------------------------------------------
    */
    Route::prefix('dashboard/mahasiswa')->middleware('role:mahasiswa')->group(function () {
        Route::get('/', [MahasiswaDashboard::class, 'index'])->name('dashboard.mahasiswa');
        Route::get('/katalog', [MahasiswaDashboard::class, 'katalog'])->name('mahasiswa.katalog');
        Route::get('/pengajuan', [MahasiswaDashboard::class, 'pengajuan'])->name('mahasiswa.pengajuan');
        Route::get('/riwayat', [MahasiswaDashboard::class, 'riwayat'])->name('mahasiswa.riwayat');
        Route::get('/profil', [MahasiswaDashboard::class, 'profil'])->name('mahasiswa.profil');
    });


    /*
    |--------------------------------------------------------------------------
    | PRODI
    |--------------------------------------------------------------------------
    */
    Route::prefix('dashboard/prodi')->middleware('role:verifikator_prodi')->group(function () {
        Route::get('/', [ProdiDashboard::class, 'index'])->name('dashboard.prodi');
    });


    /*
    |--------------------------------------------------------------------------
    | PUSKAKA
    |--------------------------------------------------------------------------
    */
    Route::prefix('dashboard/puskaka')->middleware('role:puskaka')->group(function () {
        Route::get('/', [PuskakaDashboard::class, 'index'])->name('dashboard.puskaka');
    });

});