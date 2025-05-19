<?php

namespace Database\Seeders; // [OKE] Namespace sudah benar

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // [OKE] Import Hash
use App\Models\User;                 // [OKE] Import User model
use App\Models\MahasiswaProfile;     // [OKE] Import MahasiswaProfile model
use Carbon\Carbon;                   // [TAMBAHKAN INI] Import Carbon untuk manipulasi tanggal

class UserSeeder extends Seeder // [OKE] Nama class sudah benar
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // === BAGIAN YANG MUNGKIN TERLEWAT DARI CONTOH SEBELUMNYA ===
        // Membuat Admin (PENTING untuk bisa login sebagai admin)
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // Cari berdasarkan email
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'), // Ganti password jika perlu
                'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // === LOOP UNTUK MAHASISWA DUMMY (Sudah ada di kode Anda) ===
        $kampusList = ['Utama', 'PSDKU Kediri', 'PSDKU Lumajang', 'PSDKU Pamekasan'];
        $prodiList = [
            'Teknik Informatika' => 'Teknologi Informasi',
            'Sistem Informasi' => 'Teknologi Informasi',
            'Manajemen Bisnis' => 'Bisnis dan Manajemen',
            'Akuntansi' => 'Ekonomi dan Bisnis',
            'Sastra Inggris' => 'Bahasa dan Sastra'
        ];
        $prodiKeys = array_keys($prodiList);

        for ($i = 1; $i <= 50; $i++) { // Buat 50 mahasiswa dummy
            // Gunakan firstOrCreate untuk menghindari duplikasi jika seeder dijalankan berkali-kali
            $mahasiswa = User::firstOrCreate(
                ['email' => 'mahasiswa' . $i . '@example.com'],
                [
                    'name' => 'Mahasiswa Dummy ' . $i,
                    'password' => Hash::make('password'),
                    'role' => 'mahasiswa',
                    'email_verified_at' => now(),
                    'created_at' => Carbon::now()->subDays(rand(0, 60)),
                    'updated_at' => Carbon::now()->subDays(rand(0, 60)),
                ]
            );

            // Cek apakah profile sudah ada sebelum membuat (jika user sudah ada)
            if (!$mahasiswa->mahasiswaProfile()->exists()) {
                $selectedProdi = $prodiKeys[array_rand($prodiKeys)];

                MahasiswaProfile::create([
                    'user_id' => $mahasiswa->id,
                    'nim' => 'NIMDUMMY' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'nik' => 'NIKDUMMY' . str_pad($i, 10, '0', STR_PAD_LEFT),
                    'no_wa' => '08123000' . str_pad($i, 4, '0', STR_PAD_LEFT),
                    'alamat_asal' => 'Alamat Asal Dummy ' . $i,
                    'alamat_sekarang' => 'Alamat Sekarang Dummy ' . $i,
                    'program_studi' => $selectedProdi,
                    'jurusan' => $prodiList[$selectedProdi],
                    'kampus' => $kampusList[array_rand($kampusList)],
                    'created_at' => $mahasiswa->created_at, // Ambil dari created_at user
                    'updated_at' => $mahasiswa->updated_at, // Ambil dari updated_at user
                ]);
            }
        }

        // Pesan konfirmasi (opsional tapi baik)
        $this->command->info('UserSeeder: User admin dan 50 mahasiswa dummy berhasil diproses/dibuat.');
    }
}