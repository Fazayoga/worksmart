<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use SoftDeletes;

    protected $table = 'shift';

    protected $fillable = [
        'perusahaan_id',
        'nama_shift',
        'jam_masuk',
        'jam_pulang',
        'toleransi_terlambat',
        'jumlah_hari_kerja',
        'hari_kerja',
        'hari_libur',
        'is_active'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'shift_id');
    }
}
