<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalPeserta;
use App\Models\Pendaftaran;
use App\Models\Jadwal;
use App\Models\HasilUjian; // Untuk hasil ujian
use Carbon\Carbon; // Untuk tanggal

class JadwalPesertaSeeder extends Seeder
{
    public function run(): void
    {
        $pendaftarTerverifikasi = Pendaftaran::where('status', 'terverifikasi')->get();
        $jadwals = Jadwal::all();

        if ($jadwals->isEmpty() || $pendaftarTerverifikasi->isEmpty()) {
            $this->command->info('Tidak ada jadwal atau pendaftar terverifikasi untuk di-seed ke jadwal_peserta.');
            return;
        }

        $nomorPesertaCounter = 1;
        $statusList = ['terdaftar', 'hadir', 'tidak_hadir', 'ujian_selesai', 'lulus', 'tidak_lulus'];


        foreach ($pendaftarTerverifikasi as $pendaftaran) {
            if (rand(0,1)) { // Tidak semua yang terverifikasi langsung dapat jadwal
                $jadwalDipilih = $jadwals->random();
                $statusUjian = $statusList[array_rand($statusList)];

                $jadwalPeserta = JadwalPeserta::create([
                    'user_id' => $pendaftaran->user_id,
                    'jadwal_id' => $jadwalDipilih->id,
                    'pendaftaran_id' => $pendaftaran->id,
                    'nomor_peserta' => 'TOEIC' . date('Y') . str_pad($nomorPesertaCounter++, 4, '0', STR_PAD_LEFT),
                    'status' => $statusUjian, // Misal 'ujian_selesai'
                ]);

                // Jika status ujian_selesai, lulus, atau tidak_lulus, buat data hasil ujian
                if (in_array($statusUjian, ['ujian_selesai', 'lulus', 'tidak_lulus'])) {
                    HasilUjian::create([
                        'user_id' => $pendaftaran->user_id,
                        'jadwal_peserta_id' => $jadwalPeserta->id,
                        'nilai_listening' => rand(200, 495),
                        'nilai_reading' => rand(200, 495),
                        'nilai_total' => rand(400, 990), // Sesuaikan dengan total listening + reading
                        'tanggal_ujian' => Carbon::parse($jadwalDipilih->tanggal_ujian_mulai)->toDateString(),
                        'file_sertifikat_path' => null, // Kosongkan dulu
                    ]);
                }
            }
        }
    }
}