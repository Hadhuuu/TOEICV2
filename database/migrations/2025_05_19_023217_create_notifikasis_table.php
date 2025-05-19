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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id(); // Kolom id int [pk, increment]
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Kolom user_id int [ref: > users.id]
            $table->string('judul');
            $table->text('isi');
            $table->string('link')->nullable(); // Link untuk aksi notifikasi (opsional)
            $table->boolean('is_read')->default(false);
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};