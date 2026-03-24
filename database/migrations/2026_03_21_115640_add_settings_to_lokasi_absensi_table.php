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
            $table->boolean('is_within_radius')->default(true)->after('radius_meter');
            $table->boolean('is_selfie')->default(false)->after('is_within_radius');
            $table->boolean('is_standby')->default(false)->after('is_selfie');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lokasi_absensi', function (Blueprint $table) {
            $table->dropColumn(['is_within_radius', 'is_selfie', 'is_standby']);
        });
    }
};
