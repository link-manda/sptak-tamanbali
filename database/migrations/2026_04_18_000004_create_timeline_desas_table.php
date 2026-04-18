<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timeline_desas', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_label');     // contoh: "Awal 1900-an"
            $table->string('judul');
            $table->text('deskripsi');
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timeline_desas');
    }
};
