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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id(); // Kolom id int [pk, increment]
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Kolom user_id int [ref: > users.id]
            // Penyesuaian status, bisa ditambah jika perlu
            $table->enum('status', ['menunggu_verifikasi', 'terverifikasi', 'ditolak', 'sudah_test_sebelumnya'])->default('menunggu_verifikasi');
            $table->text('catatan_admin')->nullable();
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};