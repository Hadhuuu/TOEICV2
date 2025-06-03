<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\HasilController;
use App\Models\HasilUjian;

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
]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
        ->name('admin.dashboard');
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswaDashboard'])
        ->name('mahasiswa.dashboard');

     //input ambe kelola hasil
    Route::get('/kelola-hasil', [HasilController::class, 'index'])->name('hasil.index');
    Route::post('/kelola-hasil', [HasilController::class, 'store'])->name('hasil.store');

    // Route hasil ujian untuk mahasiswa
    // Exam Results Routes
    Route::get('/mahasiswa/hasil-ujian', [ExamResultController::class, 'index'])->name('mahasiswa.exam-results.index');
    Route::get('/hasil-ujian/sertifikat/{id}', [ExamResultController::class, 'downloadCertificate'])->name('exam-results.download-certificate');
});

require __DIR__.'/auth.php';
