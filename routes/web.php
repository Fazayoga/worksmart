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


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\JabatanAksesController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgotPassword', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgotPassword', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai');
    Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

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

    Route::get('Jabatan-Akses', [JabatanAksesController::class, 'index'])->name('Jabatan-Akses');
    Route::post('Jabatan-Akses', [JabatanAksesController::class, 'store'])->name('Jabatan-Akses.store');
    Route::post('Jabatan-Akses/{id}', [JabatanAksesController::class, 'update'])->name('Jabatan-Akses.update');
    Route::put('Jabatan-Akses/{id}', [JabatanAksesController::class, 'updateJabatan'])->name('Jabatan-Akses.rename');
    Route::delete('Jabatan-Akses/{id}', [JabatanAksesController::class, 'destroy'])->name('Jabatan-Akses.destroy');

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

    Route::get('Billing', [BillingController::class, 'index'])->name('Billing');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/details', [ProfileController::class, 'updateDetails'])->name('profile.details.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});
