<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perusahaan;
use App\Models\Billing;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuperadminController extends Controller
{
    public function dashboard()
    {
        // 1. Income (Total paid billing)
        $income = Billing::where('payment_status', 'paid')->sum('nominal_total');
        $lastIncomeDate = Billing::where('payment_status', 'paid')->latest('tanggal_bayar')->value('tanggal_bayar');

        // 2. Total Perusahaan
        $totalPerusahaan = Perusahaan::count();

        // 3. Total User
        $totalUser = User::count();

        // 4. Data for Chart (7 Hari Terakhir)
        $labels = [];
        $dataPerusahaan = [];
        $dataUser = [];
        $indonesianDays = [0 => 'Min', 1 => 'Sen', 2 => 'Sel', 3 => 'Rab', 4 => 'Kam', 5 => 'Jum', 6 => 'Sab'];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $indonesianDays[$date->dayOfWeek]; 
            
            $dataPerusahaan[] = Perusahaan::whereDate('created_at', $date)->count();
            $dataUser[] = User::whereDate('created_at', $date)->count();
        }

        // 5. Data Perusahaan Tab (List of companies with users count)
        $perusahaanList = Perusahaan::withCount('users')->orderBy('created_at', 'desc')->get();

        // 6. Data Absen Tab (List of companies with absen count)
        $absenList = DB::table('perusahaan')
            ->select('perusahaan.id', 'perusahaan.nama_perusahaan')
            ->leftJoin('karyawan', 'karyawan.perusahaan_id', '=', 'perusahaan.id')
            ->leftJoin('absensi', 'absensi.karyawan_id', '=', 'karyawan.id')
            ->selectRaw('COUNT(absensi.id) as total_absen')
            ->groupBy('perusahaan.id', 'perusahaan.nama_perusahaan')
            ->orderBy('total_absen', 'desc')
            ->get();

        return view('superadmin.dashboard.index', compact(
            'income', 'lastIncomeDate', 'totalPerusahaan', 'totalUser',
            'labels', 'dataPerusahaan', 'dataUser',
            'perusahaanList', 'absenList'
        ));
    }

    public function user(Request $request)
    {
        $search = $request->input('search');

        $users = User::with('perusahaan')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalIos = 4536; // Placeholder matching the requested mockup
        $totalUsers = User::count();

        return view('superadmin.user.index', compact('users', 'search', 'totalIos', 'totalUsers'));
    }
}
