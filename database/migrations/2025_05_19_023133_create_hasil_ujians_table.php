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
        Schema::create('hasil_ujians', function (Blueprint $table) {
            $table->id(); // Kolom id int [pk, increment]
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Kolom user_id int [ref: > users.id]
            // Menghubungkan ke entri jadwal peserta spesifik
            $table->foreignId('jadwal_peserta_id')->nullable()->constrained('jadwal_peserta')->onDelete('set null');
            $table->integer('nilai_listening')->nullable(); // Untuk mengakomodasi jika nilai dipisah
            $table->integer('nilai_reading')->nullable();  // Untuk mengakomodasi jika nilai dipisah
            $table->integer('nilai_total'); // Atau hanya nilai int jika nilai tunggal
            $table->date('tanggal_ujian'); // Tanggal saat ujian dilaksanakan
            $table->string('file_sertifikat_path')->nullable(); // Path ke file sertifikat
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_ujians');
    }
};