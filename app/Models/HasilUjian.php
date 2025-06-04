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
        'jadwal_peserta_id',
        'nilai_listening',
        'nilai_reading',
        'nilai_total',
        'tanggal_ujian',
        'file_sertifikat_path',
        // tambahkan kolom lain jika ada yang di-mass assign dari Excel
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