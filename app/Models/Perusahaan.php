<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perusahaan extends Model
{
    use SoftDeletes;

    protected $table = 'perusahaan';

    protected $fillable = [
        'nama_perusahaan',
        'email',
        'no_telp',
        'alamat',
        'logo',
        'status',
        'trial_ends_at',
        'subscription_status'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function divisi()
    {
        return $this->hasMany(Divisi::class);
    }
}
