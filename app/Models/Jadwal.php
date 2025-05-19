<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';

    protected $fillable = [
        'tanggal_ujian_mulai', // Sesuai migrasi terakhir kita
        'tanggal_ujian_selesai',
        'lokasi',
        'kuota',
    ];

    protected $casts = [
        'tanggal_ujian_mulai' => 'datetime',
        'tanggal_ujian_selesai' => 'datetime',
    ];

    public function jadwalPesertas() // Jamak karena satu jadwal bisa memiliki banyak peserta
    {
        return $this->hasMany(JadwalPeserta::class, 'jadwal_id', 'id');
    }

    // Relasi many-to-many ke User melalui jadwal_peserta (peserta ujian)
    public function pesertas()
    {
        return $this->belongsToMany(User::class, 'jadwal_peserta', 'jadwal_id', 'user_id')
                    ->withPivot('nomor_peserta', 'status') // Ambil data tambahan dari tabel pivot
                    ->withTimestamps(); // Jika tabel pivot memiliki timestamps
    }
}