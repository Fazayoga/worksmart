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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('perusahaan_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('divisi_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->unsignedBigInteger('shift_id')->nullable();

            $table->string('nik');
            $table->date('tanggal_masuk')->index();

            $table->enum('status_karyawan', ['tetap','kontrak','magang'])
                ->index();

            $table->decimal('gaji_pokok', 15, 2)->default(0);

            $table->boolean('is_active')->default(true)->index();

            // Personal Details
            $table->string('no_ktp', 20)->nullable();
            $table->string('no_kk', 20)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat_tinggal_provinsi')->nullable();
            $table->string('alamat_tinggal_kabupaten')->nullable();
            $table->string('alamat_tinggal_kecamatan')->nullable();
            $table->text('alamat_tinggal_lengkap')->nullable();
            $table->string('alamat_ktp_provinsi')->nullable();
            $table->string('alamat_ktp_kabupaten')->nullable();
            $table->string('alamat_ktp_kecamatan')->nullable();
            $table->text('alamat_ktp_lengkap')->nullable();
            $table->string('no_hp_1', 20)->nullable();
            $table->string('no_hp_2', 20)->nullable();
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan'])->nullable();
            $table->enum('status_pernikahan', ['Lajang', 'Nikah', 'Janda', 'Duda'])->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha'])->nullable();
            $table->enum('golongan_darah', ['O', 'A', 'B', 'AB'])->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->integer('jumlah_saudara')->nullable();
            $table->string('kontak_darurat_nama')->nullable();
            $table->string('kontak_darurat_hp', 20)->nullable();
            $table->string('kontak_darurat_status')->nullable();

            // Social Media links
            $table->string('link_facebook')->nullable();
            $table->string('link_twitter')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_linkedin')->nullable();
            $table->string('link_website')->nullable();

            $table->timestamps();
            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | INDEX STRATEGY (SUPER PENTING)
            |--------------------------------------------------------------------------
            */

            $table->unique(['perusahaan_id', 'nik']);
            $table->unique('user_id');

            $table->index('perusahaan_id');
            $table->index(['perusahaan_id', 'divisi_id']);
            $table->index(['perusahaan_id', 'jabatan_id']);
            $table->index(['perusahaan_id', 'status_karyawan']);
            $table->index(['perusahaan_id', 'is_active']);

            /*
            |--------------------------------------------------------------------------
            | FOREIGN KEYS
            |--------------------------------------------------------------------------
            */

            $table->foreign('perusahaan_id')
                ->references('id')
                ->on('perusahaan')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('divisi_id')
                ->references('id')
                ->on('divisi')
                ->cascadeOnDelete();

            $table->foreign('jabatan_id')
                ->references('id')
                ->on('jabatan')
                ->cascadeOnDelete();

            $table->foreign('shift_id')
                ->references('id')
                ->on('shift')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
