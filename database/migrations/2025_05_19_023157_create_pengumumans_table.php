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
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->id(); // Kolom id int [pk, increment]
            $table->string('judul');
            $table->text('isi');
            $table->timestamp('tanggal_publish')->nullable(); // Kapan pengumuman ini dipublikasikan
            $table->enum('jenis', ['pendaftaran', 'jadwal_ujian', 'hasil_ujian', 'pengambilan_sertifikat', 'lainnya']);
            $table->boolean('is_published')->default(false); // Status publikasi
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};