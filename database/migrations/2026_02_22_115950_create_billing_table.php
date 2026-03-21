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

            $table->string('nomor_transaksi')->unique();
            $table->foreignId('paket_id')->nullable()->constrained('paket_langganan')->cascadeOnDelete();
            $table->string('tipe');
            $table->decimal('nominal', 15, 2);
            $table->text('keterangan')->nullable();
            $table->decimal('nominal_total', 15, 2);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->datetime('tanggal_bayar')->nullable();
            $table->enum('status',['active','expired'])->default('active');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->string('file_invoice')->nullable();
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
