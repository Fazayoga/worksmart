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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id')
                ->constrained('perusahaan')
                ->cascadeOnDelete();

            $table->foreignId('dibuat_oleh')->constrained('users')->cascadeOnDelete();

            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->date('deadline')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
