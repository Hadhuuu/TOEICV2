<?php

namespace App\Models; // Pastikan namespace ini benar

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaProfile extends Model // Pastikan nama class ini benar
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nim',
        'nik',
        'no_wa',
        'alamat_asal',
        'alamat_sekarang',
        'program_studi',
        'jurusan',
        'kampus',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}