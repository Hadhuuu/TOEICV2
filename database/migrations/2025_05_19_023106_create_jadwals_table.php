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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id(); // Kolom id int [pk, increment]
            $table->dateTime('tanggal_ujian_mulai'); // Menggunakan dateTime untuk waktu yang lebih spesifik
            $table->dateTime('tanggal_ujian_selesai')->nullable(); // Opsional jika ada rentang waktu ujian
            $table->string('lokasi'); // Bisa "Online" atau nama tempat
            $table->integer('kuota');
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};