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
        Schema::create('absensi_approval', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('perusahaan_id');
            $table->unsignedBigInteger('absensi_id');

            $table->unsignedBigInteger('requested_by');
            $table->unsignedBigInteger('approved_by')->nullable();

            $table->enum('status', ['pending','disetujui','ditolak'])
                ->default('pending')
                ->index();

            $table->text('catatan')->nullable();
            $table->timestamp('approved_at')->nullable()->index();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | INDEX STRATEGY
            |--------------------------------------------------------------------------
            */

            // 1️⃣ Satu absensi hanya boleh punya 1 approval aktif
            $table->unique('absensi_id');

            // 2️⃣ Dashboard pending approval per perusahaan
            $table->index(['perusahaan_id', 'status']);

            // 3️⃣ Filter berdasarkan approver
            $table->index(['approved_by', 'status']);

            // 4️⃣ Filter berdasarkan requester
            $table->index(['requested_by', 'status']);

            /*
            |--------------------------------------------------------------------------
            | FOREIGN KEYS
            |--------------------------------------------------------------------------
            */

            $table->foreign('perusahaan_id')
                ->references('id')
                ->on('perusahaan')
                ->cascadeOnDelete();

            $table->foreign('absensi_id')
                ->references('id')
                ->on('absensi')
                ->cascadeOnDelete();

            $table->foreign('requested_by')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('absensi_approval');
    }
};
