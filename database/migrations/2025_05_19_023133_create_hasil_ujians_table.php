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
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('jadwal_peserta_id')->nullable()->constrained('jadwal_peserta')->onDelete('set null');
            $table->integer('nilai_listening')->nullable();
            $table->integer('nilai_reading')->nullable();
            $table->integer('nilai_total');
            $table->date('tanggal_ujian');
            $table->string('file_sertifikat_path')->nullable();
            $table->timestamps();
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