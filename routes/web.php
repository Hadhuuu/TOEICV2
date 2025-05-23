<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\Mahasiswa\PendaftaranController as MahasiswaPendaftaranController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di bawah ini adalah definisi rute aplikasi. Halaman utama TOEIC
| tersedia tanpa login. Dashboard dan fitur lainnya tetap dilindungi.
|--------------------------------------------------------------------------
*/

// ✅ Halaman publik (tanpa login)
Route::get('/', function () {
    return view('home'); // <- ini akan menampilkan home.blade.php
});

// ✅ Dashboard default Laravel (butuh login dan verifikasi email)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Rute yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard admin dan mahasiswa
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswaDashboard'])->name('mahasiswa.dashboard');

    // Kelola hasil TOEIC
    Route::get('/kelola-hasil', [HasilController::class, 'index'])->name('hasil.index');
    Route::post('/kelola-hasil', [HasilController::class, 'store'])->name('hasil.store');

    // Rute mahasiswa - Pendaftaran TOEIC
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/pendaftaran-toeic', [MahasiswaPendaftaranController::class, 'create'])->name('pendaftaran.create');
        Route::post('/pendaftaran-toeic', [MahasiswaPendaftaranController::class, 'store'])->name('pendaftaran.store');
    });

    // Rute admin - Manajemen User
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', AdminUserController::class);
    });
});

require __DIR__.'/auth.php';
