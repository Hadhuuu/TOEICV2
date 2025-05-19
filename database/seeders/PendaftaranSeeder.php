<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\User;
use Carbon\Carbon;

class PendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        $statusList = ['menunggu_verifikasi', 'terverifikasi', 'ditolak', 'sudah_test_sebelumnya'];

        foreach ($mahasiswas as $mahasiswa) {
            // Tidak semua mahasiswa mendaftar, atau mendaftar di waktu berbeda
            if (rand(0, 1)) {
                Pendaftaran::create([
                    'user_id' => $mahasiswa->id,
                    'status' => $statusList[array_rand($statusList)],
                    'catatan_admin' => (rand(0,1) ? 'Catatan dummy untuk pendaftaran.' : null),
                    // Gunakan created_at dari user agar konsisten atau variasi sedikit
                    'created_at' => Carbon::parse($mahasiswa->created_at)->addDays(rand(0, 5)),
                    'updated_at' => Carbon::parse($mahasiswa->created_at)->addDays(rand(5, 10)),
                ]);
            }
        }
    }
}