<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:2048', // PDF maksimal 2MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            // Menyimpan file ke 'storage/app/public/pengumuman'
            // Nama file akan di-generate otomatis dan unik
            $filePath = $request->file('file')->store('pengumuman', 'public');
        }

        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'file' => $filePath,
            'is_published' => true, // Otomatis publikasikan
            'tanggal_publish' => now(), // Set tanggal publikasi sekarang
            // 'jenis' => 'Umum', // Anda bisa menambahkan input untuk ini di form admin jika perlu
        ]);

        return redirect()->route('admin.pengumuman.create') // Atau ke halaman daftar pengumuman admin
                         ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function create()
    {
        // View ini adalah form untuk admin membuat pengumuman
        return view('admin.pengumuman.create');
    }

    // Method BARU untuk menampilkan pengumuman ke mahasiswa
    public function indexMahasiswa()
    {
        $pengumuman = Pengumuman::where('is_published', true)
                                 // ->where('tanggal_publish', '<=', now()) // Jika ingin yang sudah melewati tanggal publish
                                 ->orderBy('tanggal_publish', 'desc') // Tampilkan yang terbaru dulu
                                 ->paginate(10); // Contoh paginasi, tampilkan 10 per halaman

        // View ini akan menampilkan daftar pengumuman untuk mahasiswa
        return view('mahasiswa.pengumuman.index', compact('pengumuman'));
    }
}