<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE billing MODIFY COLUMN payment_status ENUM('paid', 'unpaid', 'pending') DEFAULT 'unpaid'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Safe down: set pending back to unpaid first, then remove from ENUM
        DB::statement("UPDATE billing SET payment_status = 'unpaid' WHERE payment_status = 'pending'");
        DB::statement("ALTER TABLE billing MODIFY COLUMN payment_status ENUM('paid', 'unpaid') DEFAULT 'unpaid'");
    }
};
