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
        Schema::create('shift', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('perusahaan_id');

            $table->string('nama_shift');
            $table->time('jam_masuk')->index();
            $table->time('jam_pulang')->index();

            $table->unsignedInteger('toleransi_terlambat')->default(0);

            $table->boolean('is_active')->default(true)->index();

            $table->timestamps();
            $table->softDeletes();

            // 🔥 INDEX STRATEGY
            $table->index('perusahaan_id');
            $table->unique(['perusahaan_id', 'nama_shift']);
            $table->index(['perusahaan_id', 'is_active']);

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
        Schema::dropIfExists('shift');
    }
};
