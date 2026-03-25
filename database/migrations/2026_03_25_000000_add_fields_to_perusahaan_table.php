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
        Schema::table('perusahaan', function (Blueprint $table) {
            $table->string('provinsi')->nullable()->after('alamat');
            $table->string('kabupaten')->nullable()->after('provinsi');
            $table->string('kecamatan')->nullable()->after('kabupaten');
            $table->string('no_wa', 30)->nullable()->after('no_telp');
            $table->string('website')->nullable()->after('no_wa');
            $table->string('bidang_industri')->nullable()->after('website');
            $table->text('deskripsi')->nullable()->after('bidang_industri');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perusahaan', function (Blueprint $table) {
            $table->dropColumn([
                'provinsi',
                'kabupaten',
                'kecamatan',
                'no_wa',
                'website',
                'bidang_industri',
                'deskripsi'
            ]);
        });
    }
};
