<?php

use App\Models\Banjar;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambahkan kolom nullable terlebih dahulu
        Schema::table('banjars', function (Blueprint $table) {
            $table->string('kode_banjar', 20)->nullable()->after('id');
        });

        // 2. Backfill seluruh data banjar eksisting dengan kode unik
        $existingBanjars = DB::table('banjars')->get();
        foreach ($existingBanjars as $b) {
            $code = Banjar::generateUniqueCode($b->nama_banjar);
            DB::table('banjars')->where('id', $b->id)->update([
                'kode_banjar' => $code,
            ]);
        }

        // 3. Ubah kolom menjadi NOT NULL dan UNIQUE
        Schema::table('banjars', function (Blueprint $table) {
            $table->string('kode_banjar', 20)->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banjars', function (Blueprint $table) {
            $table->dropColumn('kode_banjar');
        });
    }
};
