<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    use HasFactory;

    protected $table = 'hasil_ujians';

    protected $fillable = [
        'user_id',
        'jadwal_peserta_id', // Sesuai migrasi terakhir kita
        'nilai_listening',   // Sesuai migrasi terakhir kita
        'nilai_reading',     // Sesuai migrasi terakhir kita
        'nilai_total',       // Sesuai migrasi terakhir kita (menggantikan 'nilai')
        'tanggal_ujian',
        'file_sertifikat_path',
    ];

    protected $casts = [
        'tanggal_ujian' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jadwalPeserta()
    {
        return $this->belongsTo(JadwalPeserta::class, 'jadwal_peserta_id', 'id');
    }
}