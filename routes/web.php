<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view(view: 'welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
        ->name('admin.dashboard');
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswaDashboard'])
        ->name('mahasiswa.dashboard');

    //input ambe kelola hasil
    Route::get('/kelola-hasil', [HasilController::class, 'index'])->name('hasil.index');
    Route::post('/kelola-hasil', [HasilController::class, 'store'])->name('hasil.store');


});

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

require __DIR__.'/auth.php';
