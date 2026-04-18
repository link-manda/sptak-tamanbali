<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prajurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('jabatan');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();  // path ke file foto di storage/public/foto-prajuru
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prajurus');
    }
};
