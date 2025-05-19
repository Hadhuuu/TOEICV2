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
        Schema::create('dokumen_mahasiswa', function (Blueprint $table) {
            $table->id(); // Kolom id int [pk, increment]
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->onDelete('cascade'); // Kolom pendaftaran_id int [ref: > pendaftarans.id]
            $table->enum('jenis_dokumen', ['ktp', 'ktm', 'pas_foto']);
            $table->string('file_path'); // Path ke file yang disimpan
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_mahasiswa');
    }
};