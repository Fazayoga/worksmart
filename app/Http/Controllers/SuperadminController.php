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
    public function absen(Request $request)
    {
        $dummyData = [
            ['nama' => 'Yasser Ibrahim', 'perusahaan' => 'PT MASTER INTI GLOBAL', 'status' => 'Absen Masuk', 'avatar' => 'Y', 'timestamp' => '29 March 2026 19:27:01'],
            ['nama' => 'Junardi', 'perusahaan' => 'PT. MULTI PRESTASI', 'status' => 'Absen Keluar', 'avatar' => 'J', 'timestamp' => '29 March 2026 20:26:42'],
            ['nama' => 'Rizal', 'perusahaan' => 'ORANGE STEAK CULTURE', 'status' => 'Absen Keluar', 'avatar' => 'R', 'timestamp' => '29 March 2026 19:25:24'],
            ['nama' => 'Bambang Suyitno', 'perusahaan' => 'CV MELATI AGRO PRIMA', 'status' => 'Absen Masuk', 'avatar' => 'B', 'timestamp' => '29 March 2026 19:25:15'],
            ['nama' => 'Saripudin', 'perusahaan' => 'TOKO MULAN TEKNIK', 'status' => 'Absen Keluar', 'avatar' => 'S', 'timestamp' => '29 March 2026 19:25:14'],
            ['nama' => 'Jihan Cantika Syaharani', 'perusahaan' => 'PT MASTER INTI GLOBAL', 'status' => 'Absen Masuk', 'avatar' => 'J', 'timestamp' => '29 March 2026 19:25:14'],
            ['nama' => 'Audi Arili', 'perusahaan' => 'INDO PLASTIK', 'status' => 'Selesai Kunjungan', 'avatar' => 'A', 'timestamp' => '29 March 2026 20:24:17'],
            ['nama' => 'Audhra Wahyu Adindha', 'perusahaan' => 'KOPKAR CIPTA SEJAHTERA', 'status' => 'Absen Keluar', 'avatar' => 'A', 'timestamp' => '29 March 2026 19:23:57'],
            ['nama' => 'Inarwati Basri', 'perusahaan' => 'CV. BUMI HARAPAN', 'status' => 'Absen Keluar', 'avatar' => 'I', 'timestamp' => '29 March 2026 21:23:33'],
        ];

        // Simulate pagination
        $perPage = 10;
        $currentPage = $request->get('page', 1);
        $totalItems = count($dummyData) * 100; // Mocking many results

        $paginatedData = new \Illuminate\Pagination\LengthAwarePaginator(
            $dummyData,
            $totalItems,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('superadmin.absen', compact('paginatedData'));
    }
}
