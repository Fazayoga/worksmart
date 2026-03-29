<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MobileAttendanceController extends Controller
{
    public function index()
    {
        return view('mobile.absensi');
    }

    public function ijin()
    {
        return view('mobile.ijin');
    }

    public function tugas()
    {
        $users = \App\Models\User::where('perusahaan_id', auth()->user()->perusahaan_id)->get();
        return view('mobile.tugas', compact('users'));
    }

    public function keuangan()
    {
        return view('mobile.keuangan');
    }

    public function riwayat()
    {
        return view('mobile.riwayat');
    }

    public function akun()
    {
        return view('mobile.akun');
    }

    public function welcome()
    {
        return view('mobile.welcome');
    }

    public function camera(Request $request)
    {
        $type = $request->query('type', 'Absensi');
        return view('mobile.camera', compact('type'));
    }

    public function storeAttendance(Request $request)
    {
        // Logic to handle photo and attendance data
        return redirect()->route('selfie-absen')->with('success', 'Absensi ' . $request->type . ' berhasil dikirim.');
    }
}
