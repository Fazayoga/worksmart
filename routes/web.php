<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\JabatanAksesController;
use App\Http\Controllers\LokasiAbsensiController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\RangkingPoinController;
use App\Http\Controllers\MobileAttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function (\Illuminate\Http\Request $request) {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    $userAgent = $request->header('User-Agent');
    $isMobile = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $userAgent);

    if ($isMobile) {
        return view('mobile.welcome');
    }

    return redirect('/login');
});

// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/forgotPassword', 'showForgotPasswordForm')->name('password.request');
    Route::post('/forgotPassword', 'sendResetLinkEmail')->name('password.email');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        if (Auth::user()->status_dev === 'superadmin') {
            return app(SuperadminController::class)->dashboard();
        }
        return view('dashboard.index');
    })->name('dashboard');

    // Superadmin Features
    Route::group(['prefix' => 'superadmin', 'as' => 'superadmin.'], function () {
        Route::get('/user', [SuperadminController::class, 'user'])->name('user.index');
        Route::get('/absen', [SuperadminController::class, 'absen'])->name('absen');
    });

    // Employee Management
    Route::controller(PegawaiController::class)->group(function () {
        Route::get('/pegawai', 'index')->name('pegawai');
        Route::post('/pegawai', 'store')->name('pegawai.store');
        Route::put('/pegawai/{id}', 'update')->name('pegawai.update');
        Route::delete('/pegawai/{id}', 'destroy')->name('pegawai.destroy');
        Route::post('/pegawai/{id}/reactivate', 'reactivate')->name('pegawai.reactivate');
        Route::get('/pegawai-export', 'exportCsv')->name('pegawai.export');
        Route::post('/pegawai-import', 'importCsv')->name('pegawai.import');
        Route::get('/pegawai-template', 'downloadTemplate')->name('pegawai.template');
    });

    // Sub-Modules & Views
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

    // Attendance Operations
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

    // Loan Operations
    Route::get('data-pinjaman', function () {
        return view('admin.pinjaman.data-pinjaman');
    })->name('data-pinjaman');

    Route::get('angsuran', function () {
        return view('admin.pinjaman.angsuran');
    })->name('angsuran');

    Route::get('jatuh-tempo', function () {
        return view('admin.pinjaman.jatuh-tempo');
    })->name('jatuh-tempo');

    // Laporan (Reporting)
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

    // Core Settings
    Route::controller(JabatanAksesController::class)->group(function () {
        Route::get('Jabatan-Akses', 'index')->name('Jabatan-Akses');
        Route::post('Jabatan-Akses', 'store')->name('Jabatan-Akses.store');
        Route::post('Jabatan-Akses/{id}', 'update')->name('Jabatan-Akses.update');
        Route::put('Jabatan-Akses/{id}', 'updateJabatan')->name('Jabatan-Akses.rename');
        Route::delete('Jabatan-Akses/{id}', 'destroy')->name('Jabatan-Akses.destroy');
    });

    Route::controller(LokasiAbsensiController::class)->group(function () {
        Route::get('Lokasi-Absensi', 'index')->name('Lokasi-Absensi');
        Route::post('Lokasi-Absensi', 'store')->name('Lokasi-Absensi.store');
        Route::put('Lokasi-Absensi/{id}', 'update')->name('Lokasi-Absensi.update');
        Route::delete('Lokasi-Absensi/{id}', 'destroy')->name('Lokasi-Absensi.destroy');
        Route::post('Lokasi-Absensi/update-settings', 'updateSettings')->name('Lokasi-Absensi.update-settings');
    });

    Route::controller(ShiftController::class)->group(function () {
        Route::get('Jam-Kerja', 'index')->name('Jam-Kerja');
        Route::post('Jam-Kerja', 'store')->name('Jam-Kerja.store');
        Route::put('Jam-Kerja/{id}', 'update')->name('Jam-Kerja.update');
        Route::delete('Jam-Kerja/{id}', 'destroy')->name('Jam-Kerja.destroy');
        Route::get('Jam-Kerja/search-staff', 'searchStaff')->name('Jam-Kerja.search-staff');
    });

    Route::controller(PerusahaanController::class)->group(function () {
        Route::get('Perusahaan', 'index')->name('Perusahaan');
        Route::post('Perusahaan', 'update')->name('Perusahaan.update');
    });

    Route::get('Potongan-Tunjangan', function () {
        return view('admin.setting.potongan-tunjangan');
    })->name('Potongan-Tunjangan');

    Route::get('Divisi-Departemen', function () {
        return view('admin.setting.divisi-departemen');
    })->name('Divisi-Departemen');

    Route::get('Riwayat-Login', function () {
        return view('admin.riwayat-login');
    })->name('Riwayat-Login');

    // Billing & Invoices
    Route::controller(BillingController::class)->group(function () {
        Route::get('billing', 'index')->name('Billing');
        Route::post('billing/buy-saldo', 'buySaldo')->name('billing.buy-saldo');
        Route::post('billing/buy-package', 'buyPackage')->name('billing.buy-package');
        Route::post('/billing/topup-saldo-gaji', 'buySaldoGaji')->name('billing.buy-saldo-gaji');
        Route::post('/billing/pay/{id}', 'pay')->name('billing.pay');
        Route::get('/billing/invoice/{id}', 'invoice')->name('billing.invoice');
    });

    // Profile Management
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'show')->name('profile');
        Route::post('/profile', 'update')->name('profile.update');
        Route::post('/profile/details', 'updateDetails')->name('profile.details.update');
        Route::post('/profile/password', 'updatePassword')->name('profile.password.update');
    });

    // Other Features
    Route::get('/rangking-poin', [RangkingPoinController::class, 'index'])->name('rangking-poin');

    // Mobile Specific
    Route::get('/mobile/selfie-absen', [MobileAttendanceController::class, 'index'])
        ->name('selfie-absen')
        ->middleware('mobile_only');

    Route::get('/mobile/ijin', [MobileAttendanceController::class, 'ijin'])
        ->name('mobile.ijin')
        ->middleware('mobile_only');

    Route::get('/mobile/tugas', [MobileAttendanceController::class, 'tugas'])
        ->name('mobile.tugas')
        ->middleware('mobile_only');

    Route::get('/mobile/keuangan', [MobileAttendanceController::class, 'keuangan'])
        ->name('mobile.keuangan')
        ->middleware('mobile_only');

    Route::get('/mobile/akun', [MobileAttendanceController::class, 'akun'])
        ->name('mobile.akun')
        ->middleware('mobile_only');

    Route::get('/mobile/camera', [MobileAttendanceController::class, 'camera'])
        ->name('mobile.camera')
        ->middleware('mobile_only');

    Route::post('/mobile/camera', [MobileAttendanceController::class, 'storeAttendance'])
        ->name('mobile.camera.store')
        ->middleware('mobile_only');

    Route::get('/mobile/riwayat', [MobileAttendanceController::class, 'riwayat'])
        ->name('mobile.riwayat')
        ->middleware('mobile_only');
});

// Mobile Unauthenticated Routes
Route::get('/mobile/welcome', [MobileAttendanceController::class, 'welcome'])
    ->name('mobile.welcome')
    ->middleware('mobile_only');

Route::get('/mobile/login', [LoginController::class, 'showLoginForm'])
    ->name('mobile.login')
    ->middleware('mobile_only');


