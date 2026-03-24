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
        Schema::table('shift', function (Blueprint $table) {
            $table->unsignedInteger('jumlah_hari_kerja')->default(5)->after('toleransi_terlambat');
            $table->text('hari_kerja')->nullable()->after('jumlah_hari_kerja');
            $table->text('hari_libur')->nullable()->after('hari_kerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shift', function (Blueprint $table) {
            $table->dropColumn(['jumlah_hari_kerja', 'hari_kerja', 'hari_libur']);
        });
    }
};
