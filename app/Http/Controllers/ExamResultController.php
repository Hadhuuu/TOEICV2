<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilUjian;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ExamResultController extends Controller
{
    /**
     * Display the user's exam results.
     *
     * @return \Illuminate\View\View
     */
    public function index()
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
            
        return view('mahasiswa.exam-results.index', [
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
    public function downloadCertificate($id)
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
        return response()->download(storage_path('app/' . $result->file_sertifikat_path));
    }
}
