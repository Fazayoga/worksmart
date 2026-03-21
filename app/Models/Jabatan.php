<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    use SoftDeletes;

    protected $table = 'jabatan';

    protected $fillable = [
        'perusahaan_id',
        'divisi_id',
        'nama_jabatan',
        'level'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function akses()
    {
        return $this->hasMany(JabatanAkses::class, 'jabatan_id');
    }

    public function hasAkses($menuSlug)
    {
        return $this->akses->pluck('menu_slug')->contains($menuSlug);
    }

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'jabatan_id');
    }
}
