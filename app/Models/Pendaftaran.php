<?php

namespace App\Models; // Pastikan namespace ini benar

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model // Pastikan nama class ini benar
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pendaftarans'; // Nama tabel jika berbeda dari konvensi jamak 'pendaftarans'

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status',
        'catatan_admin',
        // 'created_at' dan 'updated_at' biasanya tidak perlu di $fillable
        // karena Laravel menanganinya secara otomatis jika timestamps di model true (default).
        // Namun, jika Anda mengisinya secara manual di seeder dan ingin aman, bisa ditambahkan.
    ];

    /**
     * Get the user that owns the pendaftaran.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the documents for the pendaftaran.
     */
    public function dokumenMahasiswa()
    {
        return $this->hasMany(DokumenMahasiswa::class);
    }

    /**
     * Get the jadwal peserta associated with the pendaftaran.
     */
    public function jadwalPeserta()
    {
        // Jika satu pendaftaran bisa memiliki banyak jadwal peserta (meski aneh)
        // return $this->hasMany(JadwalPeserta::class);
        // Atau jika satu pendaftaran hanya untuk satu jadwal peserta
        return $this->hasOne(JadwalPeserta::class);
    }
}