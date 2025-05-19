<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'dokumen_mahasiswa';

    protected $fillable = [
        'pendaftaran_id',
        'jenis_dokumen',
        'file_path',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'id');
    }
}