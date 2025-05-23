<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilController;

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
});

<<<<<<< HEAD
// Rute auth bawaan Laravel Breeze atau Jetstream
=======
// routes/web.php

use App\Http\Controllers\Mahasiswa\PendaftaranController as MahasiswaPendaftaranController; // Alias agar tidak bentrok jika ada PendaftaranController lain

Route::middleware(['auth'])->group(function () {
    // ... (route dashboard mahasiswa lainnya) ...

    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        // ... (route dashboard mahasiswa)
        // Route::get('/dashboard', [DashboardController::class, 'mahasiswaDashboard'])->name('dashboard');

        // Pendaftaran TOEIC Mahasiswa
        Route::get('/pendaftaran-toeic', [MahasiswaPendaftaranController::class, 'create'])->name('pendaftaran.create');
        Route::post('/pendaftaran-toeic', [MahasiswaPendaftaranController::class, 'store'])->name('pendaftaran.store');
    });
});

// routes/web.php

// ... (use statements lainnya)
use App\Http\Controllers\Admin\UserController as AdminUserController; // Alias

Route::middleware(['auth'])->group(function () {
    // ... (route dashboard admin dan mahasiswa lainnya) ...

    Route::prefix('admin')->name('admin.')->group(function () {
        // Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        // ... (route admin lainnya jika ada) ...

        // Manajemen User
        Route::resource('users', AdminUserController::class);
        // Ini akan otomatis membuat route untuk:
        // admin.users.index, admin.users.create, admin.users.store,
        // admin.users.show, admin.users.edit, admin.users.update, admin.users.destroy
    });
});

>>>>>>> 96d4551c58715d04a003255d87625a1e00bc5aaf
require __DIR__.'/auth.php';
