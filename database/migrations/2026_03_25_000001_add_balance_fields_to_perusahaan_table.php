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
        Schema::table('perusahaan', function (Blueprint $table) {
            $table->decimal('saldo_utama', 15, 2)->default(0)->after('subscription_status');
            $table->decimal('saldo_bonus', 15, 2)->default(0)->after('saldo_utama');
            $table->decimal('saldo_gaji', 15, 2)->default(0)->after('saldo_bonus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perusahaan', function (Blueprint $table) {
            $table->dropColumn(['saldo_utama', 'saldo_bonus', 'saldo_gaji']);
        });
    }
};
