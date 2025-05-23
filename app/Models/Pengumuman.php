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
        'file',
        'tanggal_publish',
        'jenis',
        'is_published',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
        'is_published' => 'boolean',
    ];
}
