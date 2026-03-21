<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billing';

    protected $fillable = [
        'perusahaan_id',
        'nomor_transaksi',
        'paket_id',
        'tipe',
        'nominal',
        'keterangan',
        'nominal_total',
        'tanggal_mulai',
        'tanggal_selesai',
        'tanggal_bayar',
        'status',
        'payment_status',
        'file_invoice'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_bayar' => 'datetime',
        'nominal' => 'decimal:2',
        'nominal_total' => 'decimal:2',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function paket()
    {
        return $this->belongsTo(PaketLangganan::class, 'paket_id');
    }
}
