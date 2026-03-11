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
        Schema::create('jabatan_permission', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('perusahaan_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->unsignedBigInteger('permission_id');

            $table->timestamps();

            // 🔥 UNIQUE (tidak boleh duplicate)
            $table->unique(['jabatan_id', 'permission_id']);

            // 🔥 INDEX STRATEGY
            $table->index('perusahaan_id');
            $table->index(['jabatan_id', 'permission_id']);
            $table->index(['perusahaan_id', 'jabatan_id']);

            // 🔐 FK
            $table->foreign('perusahaan_id')
                ->references('id')
                ->on('perusahaan')
                ->cascadeOnDelete();

            $table->foreign('jabatan_id')
                ->references('id')
                ->on('jabatan')
                ->cascadeOnDelete();

            $table->foreign('permission_id')
                ->references('id')
                ->on('permission')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_permission');
    }
};
