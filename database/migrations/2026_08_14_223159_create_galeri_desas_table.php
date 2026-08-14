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
        Schema::create('galeri_desas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori')->default('upakara')->index();
            $table->text('deskripsi')->nullable();
            $table->string('foto');
            $table->date('tanggal_kegiatan')->nullable();
            $table->integer('urutan')->default(0)->index();
            $table->boolean('is_aktif')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri_desas');
    }
};
