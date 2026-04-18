<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Mengubah kolom role dari ENUM ke STRING agar lebih fleksibel
     * untuk penambahan role baru di masa depan.
     */
    public function up(): void
    {
        // SQLite tidak mendukung ALTER COLUMN secara langsung,
        // sehingga kita buat tabel baru lalu rename.
        // Untuk MySQL/PostgreSQL, cukup modifikasi kolom.
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('masyarakat')->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('masyarakat')->change();
        });
    }
};
