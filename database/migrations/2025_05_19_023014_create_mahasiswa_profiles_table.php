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
        Schema::create('mahasiswa_profiles', function (Blueprint $table) {
            $table->id(); // Kolom id int [pk, increment]
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Kolom user_id int [ref: > users.id]
            $table->string('nim')->unique(); // NIM sebaiknya unik
            $table->string('nik')->unique(); // NIK sebaiknya unik
            $table->string('no_wa');
            $table->text('alamat_asal');
            $table->text('alamat_sekarang');
            $table->string('program_studi');
            $table->string('jurusan');
            $table->enum('kampus', ['Utama', 'PSDKU Kediri', 'PSDKU Lumajang', 'PSDKU Pamekasan']);
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_profiles');
    }
};