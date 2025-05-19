<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View; // Import View
use App\Models\Pendaftaran; // Import Pendaftaran
use App\Models\Jadwal;     // Import Jadwal
use App\Models\User;       // Import User
use App\Models\MahasiswaProfile; // Import MahasiswaProfile
use App\Models\HasilUjian; // Import HasilUjian
use Carbon\Carbon;         // Import Carbon
use Illuminate\Support\Facades\DB; // Import DB Facade

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard untuk admin.
     */
    public function adminDashboard(): View
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // --- Data untuk Summary Cards ---
        $totalPendaftar = Pendaftaran::count();
        $pendaftarMenungguVerifikasi = Pendaftaran::where('status', 'menunggu_verifikasi')->count();
        $jadwalUjianAktif = Jadwal::where('tanggal_ujian_mulai', '>=', now())->count();
        // Asumsi 'ujian_selesai' berarti sudah ujian
        $totalPesertaSudahUjian30Hari = HasilUjian::where('tanggal_ujian', '>=', Carbon::now()->subDays(30))->count();


        // --- Data untuk Chart Pendaftar Baru Mingguan ---
        $pendaftarMingguan = Pendaftaran::select(
                DB::raw('WEEK(created_at) as minggu'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->where('created_at', '>=', Carbon::now()->subWeeks(4)->startOfWeek())
            ->groupBy('minggu')
            ->orderBy('minggu', 'asc')
            ->get()
            ->mapWithKeys(function ($item) {
                // Membuat label minggu yang lebih manusiawi, misal "Minggu ke-X (YYYY)"
                // Atau sederhananya nomor minggu saja
                return ['Minggu ' . $item->minggu => $item->jumlah];
            });
        // Pastikan ada 4 minggu, isi 0 jika tidak ada data
        $labelsPendaftarMingguan = [];
        $dataPendaftarMingguan = [];
        for ($i = 3; $i >= 0; $i--) { // 4 minggu terakhir, dari paling lama ke terbaru
            $mingguKe = Carbon::now()->subWeeks($i)->weekOfYear;
            $labelsPendaftarMingguan[] = "Minggu Ke-" . $mingguKe;
            $dataPendaftarMingguan[] = $pendaftarMingguan->get('Minggu ' . $mingguKe, 0);
        }


        // --- Data untuk Chart Distribusi Kampus ---
        $distribusiKampus = MahasiswaProfile::join('pendaftarans', 'mahasiswa_profiles.user_id', '=', 'pendaftarans.user_id')
            ->select('mahasiswa_profiles.kampus', DB::raw('COUNT(pendaftarans.id) as jumlah'))
            ->groupBy('mahasiswa_profiles.kampus')
            ->pluck('jumlah', 'kampus'); // Hasilnya: ['Utama' => 10, 'PSDKU Kediri' => 5]


        // --- Data untuk Aktivitas Terbaru ---
        $pendaftarTerbaruMenunggu = Pendaftaran::with('user') // Eager load user
            ->where('status', 'menunggu_verifikasi')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $jadwalTerdekat = Jadwal::where('tanggal_ujian_mulai', '>=', now())
            ->orderBy('tanggal_ujian_mulai', 'asc')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'pendaftarMenungguVerifikasi',
            'jadwalUjianAktif',
            'totalPesertaSudahUjian30Hari',
            'labelsPendaftarMingguan', // Kirim labels dan data terpisah
            'dataPendaftarMingguan',   // untuk chart
            'distribusiKampus',
            'pendaftarTerbaruMenunggu',
            'jadwalTerdekat'
        ));
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