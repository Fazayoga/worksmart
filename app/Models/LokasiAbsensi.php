<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LokasiAbsensi extends Model
{
    use SoftDeletes;

    protected $table = 'lokasi_absensi';

    protected $fillable = [
        'perusahaan_id',
        'nama_lokasi',
        'alamat',
        'latitude',
        'longitude',
        'radius_meter',
        'zona_waktu',
        'is_within_radius',
        'is_selfie',
        'is_standby',
        'is_active'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }
}
