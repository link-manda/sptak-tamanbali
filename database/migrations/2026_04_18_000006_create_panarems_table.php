<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('panarems', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('nomor_pararem')->nullable();   // contoh: "No. 01/PA/2024"
            $table->string('status')->default('aktif');    // aktif | evaluasi | tidak_aktif
            $table->text('deskripsi');
            $table->string('file_pdf')->nullable();
            $table->string('nama_file_asli')->nullable();
            $table->date('tanggal_ditetapkan')->nullable();
            $table->date('berlaku_mulai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panarems');
    }
};
