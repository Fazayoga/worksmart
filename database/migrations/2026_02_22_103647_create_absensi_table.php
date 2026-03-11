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
        Schema::create('absensi', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('perusahaan_id');
            $table->unsignedBigInteger('karyawan_id');

            $table->date('tanggal')->index();

            $table->time('jam_masuk')->nullable();
            $table->string('foto_masuk', 255)->nullable();
            $table->decimal('lat_masuk', 10, 7)->nullable();
            $table->decimal('lng_masuk', 10, 7)->nullable();

            $table->time('jam_keluar')->nullable();
            $table->string('foto_keluar', 255)->nullable();
            $table->decimal('lat_keluar', 10, 7)->nullable();
            $table->decimal('lng_keluar', 10, 7)->nullable();

            $table->enum('status', ['hadir','izin','sakit','cuti','alpha'])
                ->nullable()
                ->index();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | SUPER IMPORTANT INDEX STRATEGY
            |--------------------------------------------------------------------------
            */

            // 1️⃣ Unik per karyawan per hari
            $table->unique(['karyawan_id', 'tanggal']);

            // 2️⃣ Query dashboard perusahaan
            $table->index(['perusahaan_id', 'tanggal']);

            // 3️⃣ Query rekap karyawan
            $table->index(['karyawan_id', 'tanggal']);

            // 4️⃣ Filter status per perusahaan
            $table->index(['perusahaan_id', 'status']);

            // 5️⃣ Composite super cepat (rekap bulanan)
            $table->index(['perusahaan_id', 'tanggal', 'status']);

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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
