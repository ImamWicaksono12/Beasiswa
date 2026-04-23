<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\BeasiswaController;
use App\Http\Controllers\Admin\UserPejabatController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;
use App\Http\Controllers\Kaprodi\DashboardController as KaprodiDashboard;
use App\Http\Controllers\Wadek\DashboardController as WadekDashboard;
use App\Http\Controllers\Warek\DashboardController as WarekDashboard;
use App\Http\Controllers\Puskaka\DashboardController as PuskakaDashboard;


Route::get('/', function () {
    if (Auth::check()) {
    return match (Auth::user()->role) {
            'admin'     => redirect('/dashboard/admin'),
            'kaprodi'   => redirect('/dashboard/kaprodi'),
            'wadek'     => redirect('/dashboard/wadek'),
            'warek'     => redirect('/dashboard/warek'),
            'puskaka'   => redirect('/dashboard/puskaka'),
            'mahasiswa' => redirect('/dashboard/mahasiswa'),
            default     => abort(403),
        };
    }

    return app(GuestController::class)->index();
})->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    Route::get('/faq', [GuestController::class, 'faq'])->name('guest.faq');
    Route::get('/pengumuman', [GuestController::class, 'announcements'])->name('guest.announcements');
    Route::get('/program-beasiswa', [GuestController::class, 'scholarshipPrograms'])->name('guest.programs');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {

    Route::prefix('dashboard/admin')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard.admin');
        Route::get('/accounts', [AdminDashboard::class, 'accounts'])->name('admin.accounts');
        Route::get('/verification', [AdminDashboard::class, 'verification'])->name('admin.verification');
        Route::get('/monitoring', [AdminDashboard::class, 'monitoring'])->name('admin.monitoring');

        // Beasiswa CRUD
        Route::resource('beasiswa', BeasiswaController::class)
            ->only(['index', 'store', 'update', 'destroy'])
            ->names('admin.beasiswa');
        Route::post('beasiswa/{beasiswa}/toggle', [BeasiswaController::class, 'toggleStatus'])
            ->name('admin.beasiswa.toggle');

        // User Pejabat CRUD
        Route::resource('users', UserPejabatController::class)
            ->only(['index', 'store', 'show', 'update', 'destroy'])
            ->names('admin.users');
        Route::post('users/{user}/toggle', [UserPejabatController::class, 'toggleStatus'])
            ->name('admin.users.toggle');
    });

    Route::prefix('dashboard/mahasiswa')->middleware('role:mahasiswa')->group(function () {
        Route::get('/', [MahasiswaDashboard::class, 'index'])->name('dashboard.mahasiswa');
        Route::get('/katalog', [MahasiswaDashboard::class, 'katalog'])->name('mahasiswa.katalog');
        Route::get('/pengajuan', [MahasiswaDashboard::class, 'pengajuan'])->name('mahasiswa.pengajuan');
        Route::get('/riwayat', [MahasiswaDashboard::class, 'riwayat'])->name('mahasiswa.riwayat');
        Route::get('/profil', [MahasiswaDashboard::class, 'profil'])->name('mahasiswa.profil');
    });

    Route::prefix('dashboard/kaprodi')->middleware('role:kaprodi')->group(function () {
        Route::get('/', [KaprodiDashboard::class, 'index'])->name('dashboard.kaprodi');
    });

    Route::prefix('dashboard/wadek')->middleware('role:wadek')->group(function () {
        Route::get('/', [WadekDashboard::class, 'index'])->name('dashboard.wadek');
    });

    Route::prefix('dashboard/warek')->middleware('role:warek')->group(function () {
        Route::get('/', [WarekDashboard::class, 'index'])->name('dashboard.warek');
    });

    Route::prefix('dashboard/puskaka')->middleware('role:puskaka')->group(function () {
        Route::get('/', [PuskakaDashboard::class, 'index'])->name('dashboard.puskaka');
    });

});