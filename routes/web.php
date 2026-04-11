<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;
use App\Http\Controllers\Prodi\DashboardController as ProdiDashboard;
use App\Http\Controllers\Puskaka\DashboardController as PuskakaDashboard;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])
    ->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/', [GuestController::class, 'index'])
        ->name('guest.home');
    
    Route::get('/faq', [GuestController::class, 'faq'])
        ->name('guest.faq');
    
    Route::get('/pengumuman', [GuestController::class, 'announcements'])
        ->name('guest.announcements');
    
    Route::get('/program-beasiswa', [GuestController::class, 'scholarshipPrograms'])
        ->name('guest.programs');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/admin', [AdminDashboard::class, 'index'])
        ->middleware('role:admin')->name('dashboard.admin');

    Route::get('/dashboard/mahasiswa', [MahasiswaDashboard::class, 'index'])
        ->middleware('role:mahasiswa')->name('dashboard.mahasiswa');

    Route::get('/dashboard/prodi', [ProdiDashboard::class, 'index'])
        ->middleware('role:verifikator_prodi')->name('dashboard.prodi');

    Route::get('/dashboard/puskaka', [PuskakaDashboard::class, 'index'])
        ->middleware('role:puskaka')->name('dashboard.puskaka');
});
