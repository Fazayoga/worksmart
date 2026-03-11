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
        Schema::create('jabatan', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('perusahaan_id');
            $table->unsignedBigInteger('divisi_id');

            $table->string('nama_jabatan');
            $table->unsignedInteger('level')->nullable()->index();

            $table->timestamps();
            $table->softDeletes();

            // 🔥 INDEX STRATEGY
            $table->index('perusahaan_id');
            $table->index(['perusahaan_id', 'divisi_id']);
            $table->unique(['perusahaan_id', 'divisi_id', 'nama_jabatan']);

            // 🔐 FOREIGN KEY
            $table->foreign('perusahaan_id')
                ->references('id')
                ->on('perusahaan')
                ->cascadeOnDelete();

            $table->foreign('divisi_id')
                ->references('id')
                ->on('divisi')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};
