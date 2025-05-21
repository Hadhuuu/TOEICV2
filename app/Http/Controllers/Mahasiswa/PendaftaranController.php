<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\MahasiswaProfile;
use App\Models\DokumenMahasiswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Untuk nama file

class PendaftaranController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $user->load('mahasiswaProfile'); // Eager load profile

        // Cek pendaftaran terakhir mahasiswa
        $pendaftaranTerakhir = Pendaftaran::where('user_id', $user->id)
                                        ->orderBy('created_at', 'desc')
                                        ->first();

        $bisaMendaftarBaru = true;
        $pesanStatus = null;

        if ($pendaftaranTerakhir) {
            if (in_array($pendaftaranTerakhir->status, ['menunggu_verifikasi', 'terverifikasi'])) {
                $bisaMendaftarBaru = false; // Tidak bisa mendaftar jika masih ada yang aktif/menunggu
                $pesanStatus = "Anda sudah memiliki pendaftaran yang sedang diproses (Status: " . Str::title(str_replace('_', ' ', $pendaftaranTerakhir->status)) . "). Mohon tunggu informasi selanjutnya.";
            } elseif ($pendaftaranTerakhir->status === 'sudah_test_sebelumnya') {
                // Kebijakan: Anggap tidak bisa mendaftar lagi jika sudah test, kecuali ada aturan khusus
                $bisaMendaftarBaru = false;
                $pesanStatus = "Anda tercatat sudah pernah mengikuti ujian TOEIC berdasarkan pendaftaran sebelumnya. Untuk informasi tes ulang, silakan hubungi UPA Bahasa.";
            }
            // Jika ditolak, $bisaMendaftarBaru tetap true (bisa daftar lagi)
            // Jika status lain yang tidak menghalangi, juga bisa daftar lagi
        }

        // Data yang mungkin sudah ada di profil untuk pre-fill form
        $profileData = $user->mahasiswaProfile ?? new MahasiswaProfile();

        // Ambil daftar kampus dari enum di model MahasiswaProfile (jika ada, atau definisikan di sini)
        // Untuk sekarang kita hardcode, idealnya dari config atau helper
        $kampusOptions = ['Utama', 'PSDKU Kediri', 'PSDKU Lumajang', 'PSDKU Pamekasan'];


        return view('mahasiswa.pendaftaran.form', compact(
            'user',
            'pendaftaranTerakhir',
            'bisaMendaftarBaru',
            'pesanStatus',
            'profileData',
            'kampusOptions'
        ));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Re-check jika bisa mendaftar (double check)
        $pendaftaranAktif = Pendaftaran::where('user_id', $user->id)
                            ->whereIn('status', ['menunggu_verifikasi', 'terverifikasi'])
                            ->first();
        if ($pendaftaranAktif) {
            return redirect()->route('mahasiswa.pendaftaran.create')->with('error', 'Anda masih memiliki pendaftaran aktif.');
        }
        // Bisa tambahkan pengecekan status 'sudah_test_sebelumnya' juga jika perlu

        $validatedData = $request->validate([
            // Validasi untuk MahasiswaProfile
            'nim' => 'required|string|max:20|unique:mahasiswa_profiles,nim,' . ($user->mahasiswaProfile->id ?? null),
            'nik' => 'required|string|max:30|unique:mahasiswa_profiles,nik,' . ($user->mahasiswaProfile->id ?? null),
            'no_wa' => 'required|string|max:20',
            'alamat_asal' => 'required|string|max:255',
            'alamat_sekarang' => 'required|string|max:255',
            'program_studi' => 'required|string|max:100',
            'jurusan' => 'required|string|max:100',
            'kampus' => 'required|string|in:Utama,PSDKU Kediri,PSDKU Lumajang,PSDKU Pamekasan',

            // Validasi untuk Dokumen
            'scan_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // max 2MB
            'scan_ktm' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pas_foto' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Pas foto biasanya image
            'persetujuan' => 'required|accepted' // Checkbox persetujuan
        ], [
            'persetujuan.required' => 'Anda harus menyetujui pernyataan sebelum mendaftar.',
            'persetujuan.accepted' => 'Anda harus menyetujui pernyataan sebelum mendaftar.',
            // Tambahkan pesan custom lain jika perlu
        ]);

        // 1. Simpan/Update MahasiswaProfile
        $mahasiswaProfile = MahasiswaProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nim' => $validatedData['nim'],
                'nik' => $validatedData['nik'],
                'no_wa' => $validatedData['no_wa'],
                'alamat_asal' => $validatedData['alamat_asal'],
                'alamat_sekarang' => $validatedData['alamat_sekarang'],
                'program_studi' => $validatedData['program_studi'],
                'jurusan' => $validatedData['jurusan'],
                'kampus' => $validatedData['kampus'],
            ]
        );

        // 2. Buat Pendaftaran baru
        $pendaftaran = Pendaftaran::create([
            'user_id' => $user->id,
            'status' => 'menunggu_verifikasi',
        ]);

        // 3. Simpan Dokumen
        $dokumenPath = "dokumen_mahasiswa/{$user->id}/{$pendaftaran->id}";

        if ($request->hasFile('scan_ktp')) {
            $fileNameKTP = 'ktp_' . time() . '.' . $request->file('scan_ktp')->getClientOriginalExtension();
            $pathKTP = $request->file('scan_ktp')->storeAs($dokumenPath, $fileNameKTP, 'public');
            DokumenMahasiswa::create([
                'pendaftaran_id' => $pendaftaran->id,
                'jenis_dokumen' => 'ktp',
                'file_path' => $pathKTP,
            ]);
        }

        if ($request->hasFile('scan_ktm')) {
            $fileNameKTM = 'ktm_' . time() . '.' . $request->file('scan_ktm')->getClientOriginalExtension();
            $pathKTM = $request->file('scan_ktm')->storeAs($dokumenPath, $fileNameKTM, 'public');
            DokumenMahasiswa::create([
                'pendaftaran_id' => $pendaftaran->id,
                'jenis_dokumen' => 'ktm',
                'file_path' => $pathKTM,
            ]);
        }

        if ($request->hasFile('pas_foto')) {
            $fileNamePasFoto = 'pasfoto_' . time() . '.' . $request->file('pas_foto')->getClientOriginalExtension();
            $pathPasFoto = $request->file('pas_foto')->storeAs($dokumenPath, $fileNamePasFoto, 'public');
            DokumenMahasiswa::create([
                'pendaftaran_id' => $pendaftaran->id,
                'jenis_dokumen' => 'pas_foto',
                'file_path' => $pathPasFoto,
            ]);
        }

        return redirect()->route('mahasiswa.pendaftaran.create')->with('success', 'Pendaftaran Anda berhasil dikirim dan sedang menunggu verifikasi.');
    }
}