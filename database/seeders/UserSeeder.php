<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import Hash
use App\Models\User;                 // Import User model
use App\Models\MahasiswaProfile;     // Import MahasiswaProfile model (jika ingin membuat profil sekaligus)

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
            'role' => 'admin',
            'email_verified_at' => now(), // Anggap email sudah terverifikasi
        ]);
        // Anda bisa tambahkan pembuatan profile untuk admin jika perlu,
        // tapi biasanya admin tidak memiliki 'mahasiswa_profile'.

        // Membuat Mahasiswa 1
        $mahasiswa1 = User::create([
            'name' => 'Mahasiswa Satu',
            'email' => 'mahasiswa1@example.com',
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
            'role' => 'mahasiswa',
            'email_verified_at' => now(),
        ]);

        // Membuat profile untuk Mahasiswa 1 (sesuaikan dengan data di tabel mahasiswa_profiles)
        MahasiswaProfile::create([
            'user_id' => $mahasiswa1->id,
            'nim' => '123456001',
            'nik' => '1112223330001',
            'no_wa' => '081234567891',
            'alamat_asal' => 'Jl. Asal No. 1, Kota Asal',
            'alamat_sekarang' => 'Jl. Sekarang No. 1, Kota Sekarang',
            'program_studi' => 'Teknik Informatika',
            'jurusan' => 'Teknologi Informasi',
            'kampus' => 'Utama',
        ]);

        // Membuat Mahasiswa 2 (opsional, untuk data lebih banyak)
        $mahasiswa2 = User::create([
            'name' => 'Mahasiswa Dua',
            'email' => 'mahasiswa2@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'email_verified_at' => now(),
        ]);

        MahasiswaProfile::create([
            'user_id' => $mahasiswa2->id,
            'nim' => '123456002',
            'nik' => '1112223330002',
            'no_wa' => '081234567892',
            'alamat_asal' => 'Jl. Merdeka No. 2, Kota Lama',
            'alamat_sekarang' => 'Jl. Baru No. 2, Kota Baru',
            'program_studi' => 'Sistem Informasi',
            'jurusan' => 'Teknologi Informasi',
            'kampus' => 'PSDKU Kediri',
        ]);

        $this->command->info('User admin dan mahasiswa berhasil dibuat.');
    }
}