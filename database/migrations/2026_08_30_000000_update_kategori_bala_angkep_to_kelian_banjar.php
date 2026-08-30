<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('prajurus')
            ->where('kategori', 'bala_angkep')
            ->update([
                'kategori' => 'kelian_banjar',
                'jabatan' => DB::raw("REPLACE(jabatan, 'Kelian Bala', 'Kelian Banjar')"),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('prajurus')
            ->where('kategori', 'kelian_banjar')
            ->update([
                'kategori' => 'bala_angkep',
                'jabatan' => DB::raw("REPLACE(jabatan, 'Kelian Banjar', 'Kelian Bala')"),
            ]);
    }
};
