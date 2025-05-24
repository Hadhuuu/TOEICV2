<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->string('file')->nullable(); // untuk file PDF jika ada
            $table->timestamp('tanggal_publish')->nullable(); // kapan dipublish
            $table->enum('jenis', ['pendaftaran', 'jadwal_ujian', 'hasil_ujian', 'pengambilan_sertifikat', 'lainnya'])->nullable(); // jenis pengumuman
            $table->boolean('is_published')->default(false); // status aktif atau tidak
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};
