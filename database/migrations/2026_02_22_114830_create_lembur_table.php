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
        Schema::create('lembur', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('perusahaan_id');
            $table->unsignedBigInteger('karyawan_id');

            $table->date('tanggal')->index();
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            $table->unsignedInteger('durasi_menit')->nullable();

            $table->text('keterangan')->nullable();

            $table->enum('status', ['pending','disetujui','ditolak'])
                ->default('pending')
                ->index();

            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable()->index();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | INDEX STRATEGY (PENTING UNTUK PERFORMA)
            |--------------------------------------------------------------------------
            */

            // Dashboard approval perusahaan
            $table->index(['perusahaan_id', 'status']);

            // Rekap lembur bulanan perusahaan
            $table->index(['perusahaan_id', 'tanggal']);

            // Rekap lembur per karyawan
            $table->index(['karyawan_id', 'tanggal']);

            // Filter approval by approver
            $table->index(['approved_by', 'status']);

            // Optional: rekap payroll cepat
            $table->index(['perusahaan_id', 'status', 'tanggal']);

            /*
            |--------------------------------------------------------------------------
            | FOREIGN KEYS
            |--------------------------------------------------------------------------
            */

            $table->foreign('perusahaan_id')
                ->references('id')
                ->on('perusahaan')
                ->cascadeOnDelete();

            $table->foreign('karyawan_id')
                ->references('id')
                ->on('karyawan')
                ->cascadeOnDelete();

            $table->foreign('approved_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembur');
    }
};
