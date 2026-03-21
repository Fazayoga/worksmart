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

        // 2. Fetch all billings
        $billings = Billing::where('perusahaan_id', $perusahaan->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('billing.index', compact('billings', 'perusahaan'));
    }

    private function checkAndGenerateBill(Perusahaan $perusahaan)
    {
        // Only generate bill if trial is over
        if ($perusahaan->trial_ends_at && now()->greaterThan($perusahaan->trial_ends_at)) {
            
            // Check if there's already a bill for the current period (monthly)
            // For simplicity, we check if a bill was created in the last 30 days
            $latestBill = Billing::where('perusahaan_id', $perusahaan->id)
                ->where('created_at', '>', now()->subMonth())
                ->first();

            if (!$latestBill) {
                // Generate new bill
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
