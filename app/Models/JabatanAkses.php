<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JabatanAkses extends Model
{
    protected $table = 'jabatan_akses';

    protected $fillable = [
        'jabatan_id',
        'menu_slug'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public static function getAvailableMenus()
    {
        return [
            'dashboard' => 'Dashboard',
            'pegawai' => 'Data Pegawai',
            'ijin-cuti' => 'Ijin / Cuti',
            'Slip-Gaji' => 'Slip Gaji',
            'broadcast' => 'Broadcast Message',
            'absensi' => 'Menu Absensi (Grup)',
            'tugas' => 'Menu Tugas (Grup)',
            'pinjaman' => 'Menu Pinjaman (Grup)',
            'laporan' => 'Menu Laporan (Grup)',
            'setting' => 'Menu Setting (Grup)',
            'Riwayat-Login' => 'Riwayat Login',
            'Billing' => 'Billing & Payment',
            'profile' => 'Profile Pengguna',
        ];
    }
}
