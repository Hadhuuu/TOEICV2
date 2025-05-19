<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View; // Import View

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard untuk admin.
     */
    public function adminDashboard(): View
    {
        // Pastikan hanya admin yang bisa akses,
        // idealnya menggunakan middleware
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.dashboard');
    }

    /**
     * Menampilkan dashboard untuk mahasiswa.
     */
    public function mahasiswaDashboard(): View
    {
        // Pastikan hanya mahasiswa yang bisa akses,
        // idealnya menggunakan middleware
        if (Auth::user()->role !== 'mahasiswa') {
            abort(403, 'Unauthorized action.');
        }
        $user = Auth::user();
        // Di sini Anda bisa memuat data lain yang dibutuhkan mahasiswa
        // contoh: status pendaftaran terakhir, jadwal ujian, dll.
        return view('mahasiswa.dashboard', compact('user'));
    }
    
}