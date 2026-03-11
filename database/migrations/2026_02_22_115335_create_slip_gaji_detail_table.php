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
        Schema::create('slip_gaji_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slip_gaji_id')->constrained('slip_gaji')->cascadeOnDelete();

            $table->enum('tipe',['tunjangan','potongan','lembur']);
            $table->string('nama');
            $table->decimal('nominal',15,2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slip_gaji_detail');
    }
};
