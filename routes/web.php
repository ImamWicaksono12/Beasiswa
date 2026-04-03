<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guest\GuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index'])
    ->name('guest.home');

Route::get('/faq', [GuestController::class, 'faq'])
    ->name('guest.faq');

Route::get('/pengumuman', [GuestController::class, 'announcements'])
    ->name('guest.announcements');

Route::get('/program-beasiswa', [GuestController::class, 'scholarshipPrograms'])
    ->name('guest.programs');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');
});
