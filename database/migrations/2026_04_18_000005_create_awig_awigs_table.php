<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('awig_awigs', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('nomor_pasal')->nullable();    // contoh: "Pasal 1", "Bab II"
            $table->text('deskripsi');
            $table->string('file_pdf')->nullable();       // path di storage/public/awig-awig/
            $table->string('nama_file_asli')->nullable(); // nama asli file untuk label unduh
            $table->date('tanggal_ditetapkan')->nullable();
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('awig_awigs');
    }
};
