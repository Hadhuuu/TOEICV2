<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_peserta', function (Blueprint $table) {
            $table->id(); // Kolom id int [pk, increment]
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Kolom user_id int [ref: > users.id]
            $table->foreignId('jadwal_id')->constrained('jadwals')->onDelete('cascade'); // Kolom jadwal_id int [ref: > jadwals.id]
            // Tambahkan pendaftaran_id untuk menghubungkan dengan pendaftaran yang disetujui
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->onDelete('cascade');
            $table->string('nomor_peserta')->unique()->nullable(); // Nomor peserta bisa di-generate
            // Penyesuaian status
            $table->enum('status', ['terdaftar', 'hadir', 'tidak_hadir', 'ujian_selesai', 'lulus', 'tidak_lulus'])->default('terdaftar');
            $table->timestamps(); // Kolom created_at dan updated_at

            // Mahasiswa tidak bisa mendaftar ke jadwal yang sama berkali-kali
            $table->unique(['user_id', 'jadwal_id', 'pendaftaran_id'], 'user_jadwal_pendaftaran_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_peserta');
    }
};