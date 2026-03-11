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
        Schema::create('riwayat_login', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('perusahaan_id');
            $table->unsignedBigInteger('user_id');

            $table->ipAddress('ip_address')->nullable();
            $table->string('device', 255)->nullable();

            $table->timestamp('login_at')->index();
            $table->timestamp('logout_at')->nullable();

            $table->timestamps();

            // 🔥 INDEX OPTIMIZATION
            $table->index(['perusahaan_id', 'user_id']);
            $table->index(['perusahaan_id', 'login_at']);
            $table->index(['user_id', 'login_at']);

            // 🔐 FOREIGN KEY
            $table->foreign('perusahaan_id')
                ->references('id')
                ->on('perusahaan')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_login');
    }
};
