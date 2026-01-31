<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});


Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/forgotPassword', function () {
    return view('auth.forgotPassword');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/pegawai', function () {
    return view('admin.pegawai.index');
})->name('pegawai');

Route::get('/Slip-Gaji', function () {
    return view('admin.slip-gaji.index');
})->name('Slip-Gaji');

Route::get('/tugas-saya', function () {
    return view('tugas.index');
})->name('tugas-saya');

Route::get('/laporan-saya', function () {
    return view('laporan.index');
})->name('laporan-saya');

Route::get('/calender', function () {
    return view('kalender.index');
})->name('calender');

Route::get('data-absensi', function () {
    return view('admin.absensi.index');
})->name('data-absensi');

Route::get('absen-disetujui', function () {
    return view('admin.persetujuan.index');
})->name('absen-disetujui');

Route::get('reimbursement', function () {
    return view('admin.reimbursement.index');
})->name('reimbursement');

Route::get('traking', function () {
    return view('admin.absensi.traking');
})->name('traking');

Route::get('ijin-cuti', function () {
    return view('admin.ijin-cuti.index');
})->name('ijin-cuti');

Route::get('manajemen-laporan', function () {
    return view('tugas.manajemen-laporan');
})->name('manajemen-laporan');

Route::get('broadcast', function () {
    return view('broadcast.broadcast');
})->name('broadcast');

Route::get('data-pinjaman', function () {
    return view('admin.pinjaman.data-pinjaman');
})->name('data-pinjaman');

Route::get('angsuran', function () {
    return view('admin.pinjaman.angsuran');
})->name('angsuran');

Route::get('jatuh-tempo', function () {
    return view('admin.pinjaman.jatuh-tempo');
})->name('jatuh-tempo');

Route::get('Laporan-Absensi', function () {
    return view('admin.laporan.laporan-absensi');
})->name('Laporan-Absensi');

Route::get('Gaji', function () {
    return view('admin.laporan.gaji');
})->name('Gaji');

Route::get('Ijin-Cuti', function () {
    return view('admin.laporan.ijin-cuti');
})->name('Ijin-Cuti');

Route::get('Reimbursement', function () {
    return view('admin.laporan.reimbursement');
})->name('Reimbursement');

Route::get('Kepegawaian', function () {
    return view('admin.laporan.kepegawaian');
})->name('Kepegawaian');

Route::get('Jabatan-Akses', function () {
    return view('admin.setting.jabatan-akses');
})->name('Jabatan-Akses');

Route::get('Lokasi-Absensi', function () {
    return view('admin.setting.lokasi-absensi');
})->name('Lokasi-Absensi');

Route::get('Jam-Kerja', function () {
    return view('admin.setting.jam-kerja');
})->name('Jam-Kerja');

Route::get('Perusahaan', function () {
    return view('admin.setting.perusahaan');
})->name('Perusahaan');

Route::get('Potongan-Tunjangan', function () {
    return view('admin.setting.potongan-tunjangan');
})->name('Potongan-Tunjangan');

Route::get('Divisi-Departemen', function () {
    return view('admin.setting.divisi-departemen');
})->name('Divisi-Departemen');

Route::get('Riwayat-Login', function () {
    return view('admin.riwayat-login');
})->name('Riwayat-Login');

Route::get('Billing', function () {
    return view('admin.billing');
})->name('Billing');
