<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BillingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $perusahaan = $user->perusahaan;

        // 1. Ensure Trial record exists in billing table (for legacy or missing records)
        $this->ensureTrialRecordExists($perusahaan);

        // 2. Check if trial has ended and if a bill for this month should be generated
        $this->checkAndGenerateBill($perusahaan);

        // 3. Auto-expire unpaid bills older than 1 day
        Billing::where('perusahaan_id', $perusahaan->id)
            ->where('payment_status', 'unpaid')
            ->where('status', 'active')
            ->where('created_at', '<', now()->subDay())
            ->update(['status' => 'expired']);

        // 4. Fetch all billings
        $billings = Billing::where('perusahaan_id', $perusahaan->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('billing.index', compact('billings', 'perusahaan'));
    }

    public function buySaldo(Request $request)
    {
        $perusahaan = Auth::user()->perusahaan;
        $valueStr = $request->input('saldo'); // e.g., "Rp 100.000" or raw value
        
        // Clean numeric value: capture only the first Rp value
        if (preg_match('/Rp\.?([\d.]+)/i', $valueStr, $matches)) {
            $nominal = (int) str_replace('.', '', $matches[1]);
        } else {
            $nominal = (int) preg_replace('/[^0-9]/', '', $valueStr);
        }
        
        if ($nominal <= 0) return back()->with('error', 'Pilih nominal saldo yang valid.');

        // Simple bonus logic based on images
        $bonus = 0;
        if ($nominal >= 500000) {
            if ($nominal == 500000) $bonus = 200000;
            elseif ($nominal == 750000) $bonus = 250000;
            elseif ($nominal == 1000000) $bonus = 300000;
            elseif ($nominal >= 5000000) $bonus = 1000000;
            else $bonus = $nominal * 0.3; // fallback 30%
        }

        Billing::create([
            'perusahaan_id' => $perusahaan->id,
            'nomor_transaksi' => 'TOPUP-' . strtoupper(Str::random(10)),
            'tipe' => 'Topup Saldo Utama',
            'nominal' => $nominal,
            'keterangan' => "Topup Saldo Rp " . number_format($nominal, 0, ',', '.') . ($bonus > 0 ? " + Bonus Rp " . number_format($bonus, 0, ',', '.') : ""),
            'nominal_total' => $nominal, // Usually price after discount, but for now same as nominal
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now(),
            'status' => 'active',
            'payment_status' => 'unpaid',
            'metadata' => json_encode(['bonus' => $bonus])
        ]);

        return back()->with('success', 'Pesanan saldo berhasil dibuat. Silakan lakukan transfer sesuai petunjuk di atas.');
    }

    public function buyPackage(Request $request)
    {
        $perusahaan = Auth::user()->perusahaan;
        $packageValue = $request->input('package');
        
        // If it's a numeric value (from the updated blade), use it directly
        // Otherwise try to parse the old string format if any
        if (is_numeric($packageValue)) {
            $nominal = (int)$packageValue;
            // Generate label based on nominal (fallback mapping)
            $labels = [
                1900000 => 'Paket Berlangganan 100 Pegawai',
                3750000 => 'Paket Berlangganan 300 Pegawai',
                5750000 => 'Paket Berlangganan 500 Pegawai',
                7500000 => 'Paket Berlangganan 700 Pegawai',
                9250000 => 'Paket Berlangganan 1000 Pegawai',
            ];
            $packageLabel = $labels[$nominal] ?? 'Paket Berlangganan Tahunan';
        } else {
            $parts = explode(' - Rp ', $packageValue);
            $nominal = count($parts) > 1 ? (int) preg_replace('/[^0-9]/', '', $parts[1]) : 0;
            $packageLabel = $parts[0] ?? 'Paket Berlangganan';
        }
        
        if ($nominal <= 0) return back()->with('error', 'Pilih paket yang valid.');

        Billing::create([
            'perusahaan_id' => $perusahaan->id,
            'nomor_transaksi' => 'PKG-' . strtoupper(Str::random(10)),
            'tipe' => 'Pembelian Paket Tahunan',
            'nominal' => $nominal,
            'keterangan' => $packageLabel . " (Per Tahun)",
            'nominal_total' => $nominal,
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addYear(),
            'status' => 'active',
            'payment_status' => 'unpaid',
        ]);

        return back()->with('success', 'Pesanan paket tahunan berhasil dibuat. Silakan lakukan transfer sesuai petunjuk.');
    }

    public function buySaldoGaji(Request $request)
    {
        $perusahaan = Auth::user()->perusahaan;
        $valueStr = $request->input('saldo_gaji');
        $customNominal = $request->input('custom_nominal');
        
        if ($valueStr === 'costume') {
            $nominal = (int) $customNominal;
        } else {
            // Clean numeric value: capture first Rp value
            if (preg_match('/Rp\.?([\d.]+)/i', $valueStr, $matches)) {
                $nominal = (int) str_replace('.', '', $matches[1]);
            } else {
                $nominal = (int) preg_replace('/[^0-9]/', '', $valueStr);
            }
        }

        if ($nominal < 100000) {
            return back()->with('error', 'Nominal saldo gaji minimal Rp 100.000.');
        }

        Billing::create([
            'perusahaan_id' => $perusahaan->id,
            'nomor_transaksi' => 'SAL gaji-' . strtoupper(Str::random(10)),
            'tipe' => 'Topup Saldo Gaji',
            'nominal' => $nominal,
            'keterangan' => "Topup Saldo Gaji Rp " . number_format($nominal, 0, ',', '.'),
            'nominal_total' => $nominal,
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now(),
            'status' => 'active',
            'payment_status' => 'unpaid',
        ]);

        return back()->with('success', 'Pesanan saldo gaji berhasil dibuat. Silakan lakukan transfer sesuai petunjuk di atas.');
    }

    public function pay(Request $request, $id)
    {
        $billing = Billing::findOrFail($id);
        if ($billing->payment_status == 'paid') return back()->with('error', 'Tagihan ini sudah terbayar.');
        if ($billing->payment_status == 'pending') return back()->with('error', 'Tagihan ini sedang dalam proses verifikasi.');

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Handle File Upload
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = 'bukti_' . $billing->nomor_transaksi . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('bukti_pembayaran', $filename, 'public');
            $billing->bukti_pembayaran = 'bukti_pembayaran/' . $filename;
        }

        $billing->payment_status = 'pending';
        $billing->save();

        return back()->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi dari Superadmin.');
    }

    public function invoice($id)
    {
        $billing = Billing::findOrFail($id);
        
        // Ensure the invoice belongs to the current user's company
        $perusahaan = Auth::user()->perusahaan;
        if ($billing->perusahaan_id !== $perusahaan->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('billing.invoice', compact('billing', 'perusahaan'));
    }

    private function checkAndGenerateBill(Perusahaan $perusahaan)
    {
        // Only generate bill if trial is over OR subscription is active but needs renewal
        if ($perusahaan->trial_ends_at && now()->greaterThan($perusahaan->trial_ends_at)) {
            
            // Check if there's already an UNPAID or PENDING bill for the current period
            $unpaidBill = Billing::where('perusahaan_id', $perusahaan->id)
                ->where('tipe', 'Tagihan Bulanan')
                ->whereIn('payment_status', ['unpaid', 'pending'])
                ->first();

            if (!$unpaidBill) {
                // Generate new bill if no unpaid bill exists for the current month
                $latestPaidBill = Billing::where('perusahaan_id', $perusahaan->id)
                    ->where('tipe', 'Tagihan Bulanan')
                    ->where('payment_status', 'paid')
                    ->where('created_at', '>', now()->subDays(25))
                    ->first();

                if (!$latestPaidBill) {
                    $employeeCount = $perusahaan->users()->count();
                    $pricePerEmployee = 5000;
                    $totalNominal = $employeeCount * $pricePerEmployee;

                    $startDate = now();
                    $endDate = now()->addMonth();

                    Billing::create([
                        'perusahaan_id' => $perusahaan->id,
                        'nomor_transaksi' => '#' . now()->format('dmY') . strtoupper(Str::random(10)),
                        'tipe' => 'Tagihan Bulanan',
                        'nominal' => $pricePerEmployee,
                        'keterangan' => "Tagihan Periode " . $startDate->format('d M Y') . " s/d " . $endDate->format('d M Y') . ", Rp " . number_format($pricePerEmployee, 0, ',', '.') . " x " . $employeeCount . " Pegawai",
                        'nominal_total' => $totalNominal,
                        'tanggal_mulai' => $startDate,
                        'tanggal_selesai' => $endDate,
                        'status' => 'active',
                        'payment_status' => 'unpaid',
                    ]);
                }
            }
        }
    }

    private function ensureTrialRecordExists(Perusahaan $perusahaan)
    {
        if ($perusahaan->trial_ends_at) {
            $trialBill = Billing::where('perusahaan_id', $perusahaan->id)
                ->where('tipe', 'LIKE', '%Free Trial%')
                ->first();

            if (!$trialBill) {
                $startDate = Carbon::parse($perusahaan->created_at);
                $endDate = Carbon::parse($perusahaan->trial_ends_at);

                Billing::create([
                    'perusahaan_id' => $perusahaan->id,
                    'nomor_transaksi' => 'TRIAL-' . strtoupper(Str::random(10)),
                    'tipe' => 'Free Trial (15 Hari)',
                    'nominal' => 0,
                    'keterangan' => 'Masa Percobaan Gratis 15 Hari',
                    'nominal_total' => 0,
                    'tanggal_mulai' => $startDate,
                    'tanggal_selesai' => $endDate,
                    'tanggal_bayar' => $startDate,
                    'status' => 'active',
                    'payment_status' => 'paid',
                    'created_at' => $startDate,
                ]);
            }
        }
    }
}
