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
        Schema::create('cuti', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('perusahaan_id');
            $table->unsignedBigInteger('karyawan_id');

            $table->date('tanggal_mulai')->index();
            $table->date('tanggal_selesai')->index();

            $table->unsignedInteger('jumlah_hari');

            $table->string('jenis_cuti')->index();
            $table->text('alasan')->nullable();

            $table->enum('status', ['pending','disetujui','ditolak'])
                ->default('pending')
                ->index();

            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable()->index();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | INDEX STRATEGY (SANGAT PENTING)
            |--------------------------------------------------------------------------
            */

            // Dashboard perusahaan
            $table->index(['perusahaan_id', 'status']);

            // Rekap cuti per karyawan
            $table->index(['karyawan_id', 'tanggal_mulai']);

            // Rekap bulanan / tahunan perusahaan
            $table->index(['perusahaan_id', 'tanggal_mulai']);

            // Filter approval
            $table->index(['approved_by', 'status']);

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
        Schema::dropIfExists('cuti');
    }
};
