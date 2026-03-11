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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('perusahaan_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('divisi_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->unsignedBigInteger('shift_id')->nullable();

            $table->string('nik');
            $table->date('tanggal_masuk')->index();

            $table->enum('status_karyawan', ['tetap','kontrak','magang'])
                ->index();

            $table->decimal('gaji_pokok', 15, 2)->default(0);

            $table->boolean('is_active')->default(true)->index();

            $table->timestamps();
            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | INDEX STRATEGY (SUPER PENTING)
            |--------------------------------------------------------------------------
            */

            $table->unique(['perusahaan_id', 'nik']);
            $table->unique('user_id');

            $table->index('perusahaan_id');
            $table->index(['perusahaan_id', 'divisi_id']);
            $table->index(['perusahaan_id', 'jabatan_id']);
            $table->index(['perusahaan_id', 'status_karyawan']);
            $table->index(['perusahaan_id', 'is_active']);

            /*
            |--------------------------------------------------------------------------
            | FOREIGN KEYS
            |--------------------------------------------------------------------------
            */

            $table->foreign('perusahaan_id')
                ->references('id')
                ->on('perusahaan')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('divisi_id')
                ->references('id')
                ->on('divisi')
                ->cascadeOnDelete();

            $table->foreign('jabatan_id')
                ->references('id')
                ->on('jabatan')
                ->cascadeOnDelete();

            $table->foreign('shift_id')
                ->references('id')
                ->on('shift')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
