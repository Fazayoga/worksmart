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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('perusahaan_id')->nullable();

            $table->string('name')->index();
            $table->string('email');
            $table->string('password');

            $table->enum('status_user', ['admin','user'])
                ->default('user')
                ->index();

            $table->enum('status_dev', ['superadmin','user'])
                ->default('user')
                ->index();

            $table->boolean('status_aktif')
                ->default(true)
                ->index();

            $table->timestamp('last_login')->nullable()->index();
            $table->string('avatar')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            // 🔥 INDEX & CONSTRAINT OPTIMIZATION
            $table->unique(['perusahaan_id', 'email']); 
            $table->index(['perusahaan_id', 'status_user']);
            $table->index(['perusahaan_id', 'status_aktif']);

            // 🔐 Foreign Key
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
        Schema::dropIfExists('users');
    }
};
