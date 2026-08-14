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
        Schema::create('program_prioritas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->string('bidang')->default('parahyangan')->index(); // parahyangan, pawongan, palemahan, tata_kelola
            $table->text('deskripsi')->nullable();
            $table->string('target_output')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->integer('tahun_anggaran')->default(date('Y'))->index();
            $table->bigInteger('estimasi_anggaran')->default(0);
            $table->bigInteger('realisasi_anggaran')->default(0);
            $table->unsignedTinyInteger('persentase_progress')->default(0); // 0 - 100
            $table->string('status')->default('direncanakan')->index(); // direncanakan, berjalan, selesai, tertunda
            $table->string('foto')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('target_selesai')->nullable();
            $table->integer('urutan')->default(0)->index();
            $table->boolean('is_tampil_beranda')->default(true)->index();
            $table->boolean('is_aktif')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_prioritas');
    }
};
