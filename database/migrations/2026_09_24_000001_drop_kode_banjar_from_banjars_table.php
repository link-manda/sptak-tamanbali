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
        Schema::table('banjars', function (Blueprint $table) {
            $table->dropUnique(['kode_banjar']);
            $table->dropColumn('kode_banjar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banjars', function (Blueprint $table) {
            $table->string('kode_banjar', 20)->nullable()->unique();
        });
    }
};
