<?php

use App\Models\Krama;
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
        // 1. Tambahkan kolom kode_krama nullable terlebih dahulu
        Schema::table('kramas', function (Blueprint $table) {
            $table->string('kode_krama', 25)->nullable()->after('banjar_id');
        });

        // 2. Backfill seluruh data krama eksisting dengan kode unik berbasis banjar
        $existingKramas = DB::table('kramas')->get();
        foreach ($existingKramas as $k) {
            $code = Krama::generateUniqueCode($k->banjar_id);
            DB::table('kramas')->where('id', $k->id)->update([
                'kode_krama' => $code,
            ]);
        }

        // 3. Ubah kolom menjadi NOT NULL dan UNIQUE
        Schema::table('kramas', function (Blueprint $table) {
            $table->string('kode_krama', 25)->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kramas', function (Blueprint $table) {
            $table->dropUnique(['kode_krama']);
            $table->dropColumn('kode_krama');
        });
    }
};
