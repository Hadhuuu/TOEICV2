<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HasilController extends Controller
{
    public function index()
    {
        return view('hasil.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'sesi' => 'required|string|max:100',
            'file_hasil' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file_hasil');
        $filename = 'hasil_' . now()->format('Ymd_His') . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/hasil', $filename);

        return back()->with('success', 'Dokumen telah diunggah.');
    }
}


