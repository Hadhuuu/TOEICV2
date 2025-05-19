<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumans';

    protected $fillable = [
        'judul',
        'isi',
        'tanggal_publish',
        'jenis',
        'is_published', // Sesuai migrasi terakhir kita
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime', // atau 'date' jika hanya tanggal
        'is_published' => 'boolean',
    ];
}