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
        Schema::create('kramas', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel banjars (Restrict on delete untuk keamanan data)
            $table->foreignId('banjar_id')->constrained('banjars')->restrictOnDelete();
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->text('alamat')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kramas');
    }
};