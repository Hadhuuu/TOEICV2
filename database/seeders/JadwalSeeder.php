<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        // Jadwal masa lalu
        Jadwal::create([
            'tanggal_ujian_mulai' => Carbon::now()->subWeeks(2)->setHour(9)->setMinute(0),
            'tanggal_ujian_selesai' => Carbon::now()->subWeeks(2)->setHour(11)->setMinute(0),
            'lokasi' => 'Online via ITC',
            'kuota' => 50,
        ]);

        // Jadwal mendatang
        Jadwal::create([
            'tanggal_ujian_mulai' => Carbon::now()->addWeek()->startOfWeek()->addDays(2)->setHour(9)->setMinute(0), // Rabu depan
            'tanggal_ujian_selesai' => Carbon::now()->addWeek()->startOfWeek()->addDays(2)->setHour(11)->setMinute(0),
            'lokasi' => 'Online via ITC',
            'kuota' => 75,
        ]);
        Jadwal::create([
            'tanggal_ujian_mulai' => Carbon::now()->addWeeks(2)->startOfWeek()->addDays(4)->setHour(13)->setMinute(0), // Jumat 2 minggu lagi
            'tanggal_ujian_selesai' => Carbon::now()->addWeeks(2)->startOfWeek()->addDays(4)->setHour(15)->setMinute(0),
            'lokasi' => 'Ruang CBT Kampus Utama',
            'kuota' => 60,
        ]);
    }
}