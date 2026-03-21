<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use SoftDeletes;

    protected $table = 'karyawan';

    protected $fillable = [
        'perusahaan_id',
        'user_id',
        'divisi_id',
        'jabatan_id',
        'shift_id',
        'nik',
        'tanggal_masuk',
        'status_karyawan',
        'gaji_pokok',
        'is_active',
        'no_ktp',
        'no_kk',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_tinggal_provinsi',
        'alamat_tinggal_kabupaten',
        'alamat_tinggal_kecamatan',
        'alamat_tinggal_lengkap',
        'alamat_ktp_provinsi',
        'alamat_ktp_kabupaten',
        'alamat_ktp_kecamatan',
        'alamat_ktp_lengkap',
        'no_hp_1',
        'no_hp_2',
        'jenis_kelamin',
        'status_pernikahan',
        'agama',
        'golongan_darah',
        'tinggi_badan',
        'berat_badan',
        'nama_ayah',
        'nama_ibu',
        'jumlah_saudara',
        'kontak_darurat_nama',
        'kontak_darurat_hp',
        'kontak_darurat_status',
        'link_facebook',
        'link_twitter',
        'link_instagram',
        'link_linkedin',
        'link_website'
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'gaji_pokok' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
