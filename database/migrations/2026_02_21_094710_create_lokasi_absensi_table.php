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
        Schema::create('lokasi_absensi', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('perusahaan_id');

            $table->string('nama_lokasi');
            $table->text('alamat')->nullable();

            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->unsignedInteger('radius_meter');

            $table->boolean('is_active')->default(true)->index();

            $table->timestamps();
            $table->softDeletes();

            // 🔥 INDEX STRATEGY
            $table->index('perusahaan_id');
            $table->unique(['perusahaan_id', 'nama_lokasi']);
            $table->index(['perusahaan_id', 'is_active']);

            // Optional kalau sering query berdasarkan koordinat
            $table->index(['latitude', 'longitude']);

            // 🔐 FK
            $table->foreign('perusahaan_id')
                ->references('id')
                ->on('perusahaan')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_absensi');
    }
};
