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
        Schema::table('lokasi_absensi', function (Blueprint $table) {
            $table->string('zona_waktu')->default('WIB')->after('radius_meter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lokasi_absensi', function (Blueprint $table) {
            $table->dropColumn('zona_waktu');
        });
    }
};
