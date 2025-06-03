<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilUjian;
use App\Models\Pendaftaran;
use App\Models\JadwalPeserta;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display the dashboard for mahasiswa.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get the latest registration
        $pendaftaranTerbaru = Pendaftaran::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();
            
        // Get the latest exam schedule
        $jadwalPeserta = JadwalPeserta::where('user_id', $user->id)
            ->with('jadwal')
            ->orderBy('created_at', 'desc')
            ->first();
            
        // Get the latest exam result
        $hasilUjian = HasilUjian::where('user_id', $user->id)
            ->orderBy('tanggal_ujian', 'desc')
            ->first();
            
        // Get the latest announcements
        $pengumumanTerbaru = Pengumuman::orderBy('tanggal_publish', 'desc')
            ->limit(3)
            ->get();
            
        return view('mahasiswa.dashboard', [
            'user' => $user,
            'pendaftaranTerbaru' => $pendaftaranTerbaru,
            'jadwalPeserta' => $jadwalPeserta,
            'hasilUjian' => $hasilUjian,
            'pengumumanTerbaru' => $pengumumanTerbaru,
        ]);
    }

    /**
     * Display the user's exam results.
     *
     * @return \Illuminate\View\View
     */
    public function hasilUjian()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // Get the latest exam result for the user
        $latestResult = HasilUjian::where('user_id', $user->id)
            ->orderBy('tanggal_ujian', 'desc')
            ->first();
            
        // Get the previous exam result for comparison
        $previousResult = HasilUjian::where('user_id', $user->id)
            ->where('id', '!=', $latestResult->id ?? 0)
            ->orderBy('tanggal_ujian', 'desc')
            ->first();
            
        return view('mahasiswa.hasil-ujian', [
            'latestResult' => $latestResult,
            'previousResult' => $previousResult,
        ]);
    }
    
    /**
     * Download the exam certificate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadSertifikat($id)
    {
        $result = HasilUjian::findOrFail($id);
        
        // Check if the user is authorized to download this certificate
        if (Auth::id() !== $result->user_id) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if certificate exists
        if (!$result->file_sertifikat_path) {
            return back()->with('error', 'Sertifikat belum tersedia.');
        }
        
        // Return the file download response
        return Storage::download($result->file_sertifikat_path, 'Sertifikat_TOEIC_' . $result->user->mahasiswaProfile->nim . '.pdf');
    }
}
