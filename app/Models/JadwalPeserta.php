<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPeserta extends Model
{
    use HasFactory;

    protected $table = 'jadwal_peserta';

    protected $fillable = [
        'user_id',
        'jadwal_id',
        'pendaftaran_id', // Sesuai migrasi terakhir kita
        'nomor_peserta',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'id');
    }

    public function hasilUjian() // Satu jadwal peserta bisa punya satu hasil ujian
    {
        return $this->hasOne(HasilUjian::class, 'jadwal_peserta_id', 'id');
    }
}