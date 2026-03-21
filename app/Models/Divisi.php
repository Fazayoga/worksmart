<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Divisi extends Model
{
    use SoftDeletes;

    protected $table = 'divisi';

    protected $fillable = [
        'perusahaan_id',
        'nama_divisi'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function jabatan()
    {
        return $this->hasMany(Jabatan::class);
    }
}
