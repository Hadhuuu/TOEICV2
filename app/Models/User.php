<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\MahasiswaProfile;

class User extends Authenticatable // Mungkin juga implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable; // Sesuaikan dengan use traits Anda

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at', // Jika Anda menambahkannya di seeder
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Breeze biasanya menggunakan ini
    ];

    /**
     * Get the mahasiswa profile associated with the user.
     */
    public function mahasiswaProfile()
    {
        // Argumen kedua adalah foreign key di tabel mahasiswa_profiles (defaultnya user_id)
        // Argumen ketiga adalah local key di tabel users (defaultnya id)
        return $this->hasOne(MahasiswaProfile::class, 'user_id', 'id');
    }

    // ... (method relasi lain jika ada, misal pendaftarans(), dll.)
}