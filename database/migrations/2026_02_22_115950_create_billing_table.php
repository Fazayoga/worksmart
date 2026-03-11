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
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id')
                ->constrained('perusahaan')
                ->cascadeOnDelete();

            $table->foreignId('paket_id')->constrained('paket_langganan')->cascadeOnDelete();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status',['active','expired'])->default('active');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->timestamps();
        });
    }

    /**      
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing');
    }
};
