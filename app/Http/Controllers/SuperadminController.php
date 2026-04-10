<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perusahaan;
use App\Models\Billing;
use App\Models\Voucher;
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

    public function billing(Request $request)
    {
        $search = $request->input('search');
        $perusahaan_id = $request->input('perusahaan_id');
        $date = $request->input('date');

        $query = Billing::with('perusahaan');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nomor_transaksi', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        if ($perusahaan_id) {
            $query->where('perusahaan_id', $perusahaan_id);
        }

        if ($date) {
            // Assuming date comes in as mm/dd/yyyy or Y-m-d, formatting accordingly
            $parsedDate = date('Y-m-d', strtotime($date));
            $query->whereDate('created_at', $parsedDate);
        }

        $billings = $query->orderByRaw("FIELD(payment_status, 'pending') DESC")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Fetch Perusahaan for Select options
        $perusahaanList = Perusahaan::orderBy('nama_perusahaan')->get();

        // Calculate Metrics
        $allPaid = Billing::where('payment_status', 'paid')->get();
        $now = now();
        $today = $now->copy()->startOfDay();
        $sevenDaysAgo = $now->copy()->subDays(7)->startOfDay();
        $startOfMonth = $now->copy()->startOfMonth();

        $totalSaldo = 0;
        $totalBonus = 0;
        $saldoBulanIni = 0;
        $bonusBulanIni = 0;
        $saldoHariIni = 0;
        $bonusHariIni = 0;
        $saldo7Hari = 0;
        $bonus7Hari = 0;

        foreach ($allPaid as $bill) {
            $nominal = $bill->nominal;
            $bonus = 0;
            if ($bill->metadata) {
                $meta = json_decode($bill->metadata, true);
                $bonus = $meta['bonus'] ?? 0;
            }

            if (in_array($bill->tipe, ['Topup Saldo Utama', 'Topup Saldo Gaji'])) {
                $totalSaldo += $nominal;
                $totalBonus += $bonus;

                if ($bill->tanggal_bayar) {
                    $d = $bill->tanggal_bayar;
                    
                    if ($d >= $startOfMonth) {
                        $saldoBulanIni += $nominal;
                        $bonusBulanIni += $bonus;
                    }
                    if ($d >= $today) {
                        $saldoHariIni += $nominal;
                        $bonusHariIni += $bonus;
                    }
                    if ($d >= $sevenDaysAgo) {
                        $saldo7Hari += $nominal;
                        $bonus7Hari += $bonus;
                    }
                }
            }
        }

        // Chart Data (12 Months Revenue)
        $chartLabels = [];
        $chartData = [];
        $indonesianMonths = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        for ($i = 11; $i >= 0; $i--) {
            $monthDate = $now->copy()->subMonthsNoOverflow($i);
            $chartLabels[] = $indonesianMonths[$monthDate->month] . ' ' . $monthDate->year;
            
            // All revenue for this month (all types of billing, since it's "Grafik Pendapatan")
            $monthSum = $allPaid->filter(function($b) use ($monthDate) {
                return $b->tanggal_bayar && $b->tanggal_bayar->format('Y-m') === $monthDate->format('Y-m');
            })->sum('nominal_total');

            $chartData[] = $monthSum;
        }

        // Vouchers
        $vouchers = Voucher::orderBy('created_at', 'desc')->get();

        return view('superadmin.billing.index', compact(
            'billings', 'search', 'perusahaanList',
            'totalSaldo', 'totalBonus', 'saldoBulanIni', 'bonusBulanIni',
            'saldoHariIni', 'bonusHariIni', 'saldo7Hari', 'bonus7Hari',
            'chartLabels', 'chartData', 'vouchers'
        ));
    }

    public function voucherStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kode' => 'required|string|unique:vouchers,kode',
            'kuota' => 'required|integer',
            'tipe' => 'required|string',
            'status' => 'required|string',
            'nominal' => 'required|numeric'
        ]);

        Voucher::create($request->all());

        return back()->with('success', 'Voucher berhasil disimpan.');
    }

    public function voucherDelete($id)
    {
        Voucher::findOrFail($id)->delete();
        return back()->with('success', 'Voucher berhasil dihapus.');
    }

    public function billingApprove(Request $request, $id)
    {
        $billing = Billing::findOrFail($id);
        
        if ($billing->payment_status === 'paid') {
            return back()->with('error', 'Tagihan ini sudah disetujui sebelumnya.');
        }

        if ($billing->payment_status !== 'pending') {
            return back()->with('error', 'Tagihan ini belum diupload bukti pembayarannya.');
        }

        $perusahaan = $billing->perusahaan;

        // Update balances based on type
        if ($billing->tipe == 'Topup Saldo Utama') {
            $perusahaan->increment('saldo_utama', $billing->nominal);
            $metadata = json_decode($billing->metadata, true);
            if (isset($metadata['bonus'])) {
                $perusahaan->increment('saldo_bonus', $metadata['bonus']);
            }
        } elseif ($billing->tipe == 'Topup Saldo Gaji') {
            $perusahaan->increment('saldo_gaji', $billing->nominal);
        } elseif ($billing->tipe == 'Pembelian Paket Tahunan') {
            $perusahaan->update([
                'subscription_status' => 'active',
                'trial_ends_at' => Carbon::parse($perusahaan->trial_ends_at ?? now())->addYear()
            ]);
        } elseif ($billing->tipe == 'Tagihan Bulanan') {
            $perusahaan->update([
                'subscription_status' => 'active',
                'trial_ends_at' => $billing->tanggal_selesai ?? Carbon::now()->addMonth()
            ]);
        }

        $billing->payment_status = 'paid';
        $billing->tanggal_bayar = now();
        $billing->save();

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi dan saldo/paket perusahaan telah diperbarui.');
    }

    public function billingReject(Request $request, $id)
    {
        $billing = Billing::findOrFail($id);
        
        if ($billing->payment_status === 'paid') {
            return back()->with('error', 'Tagihan ini sudah disetujui, tidak bisa ditolak.');
        }

        $billing->payment_status = 'unpaid';
        $billing->bukti_pembayaran = null; // Clear proof
        $billing->save();

        return back()->with('success', 'Pembayaran telah ditolak dan status dikembalikan ke Belum Bayar.');
    }
}
