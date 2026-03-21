@extends('layouts.app')

@section('title', 'Billing')

@section('content')
    @php
        $perusahaan = Auth::user()->perusahaan;
        $trialEndsAt = $perusahaan->trial_ends_at ? \Carbon\Carbon::parse($perusahaan->trial_ends_at) : null;
        $daysLeft = $trialEndsAt ? (int) ceil(now()->diffInSeconds($trialEndsAt, false) / 86400) : 0;
        if ($daysLeft < 0) {
            $daysLeft = 0;
        }

        $jumlahPegawai = $perusahaan->users()->count();
        $biayaPerPegawai = 5000;
        $totalTagihan = $jumlahPegawai * $biayaPerPegawai;
    @endphp
    <div class="row g-4 mb-4">


        <div class="col-lg-8">
            <div class="row g-4">


                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="billing-icon">
                                    <i class="bx bx-calendar"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Masa Aktif (Trial)</small>
                                    <h5 class="mb-0 fw-semibold">{{ $daysLeft }} Hari</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="billing-icon">
                                    <i class="bx bx-group"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Pengguna</small>
                                    <h5 class="mb-0 fw-semibold">{{ $jumlahPegawai }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="billing-icon">
                                    <i class="bx bx-file"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Tagihan</small>
                                    <h5 class="mb-0 fw-semibold">Rp {{ number_format($totalTagihan, 0, ',', '.') }},-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="billing-icon">
                                    <i class="bx bx-wallet"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Saldo Utama</small>
                                    <h5 class="mb-0 fw-semibold">Rp 5.048.663,-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="billing-icon">
                                    <i class="bx bx-dollar"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Saldo Gaji</small>
                                    <h5 class="mb-0 fw-semibold">0</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="billing-icon">
                                    <i class="bx bx-gift"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Saldo Bonus</small>
                                    <h5 class="mb-0 fw-semibold">Rp 4.975.333,-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-lg-4 col-md-6 col-12">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column gap-3 justify-content-center">

                    <!-- Saldo -->
                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <select class="form-select">
                            <option>-- Pilih Saldo --</option>
                            <option>Rp 100.000</option>
                            <option>Rp 500.000</option>
                        </select>
                        <button class="btn btn-primary w-100 w-sm-auto">
                            Beli Saldo
                        </button>
                    </div>

                    <!-- Paket -->
                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <select class="form-select">
                            <option>-- Pilih Paket Tahunan --</option>
                            <option>Paket 1 Tahun</option>
                        </select>
                        <button class="btn btn-primary w-100 w-sm-auto">
                            Beli Paket
                        </button>
                    </div>

                    <!-- Saldo Gaji -->
                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <select class="form-select">
                            <option>-- Pilih Saldo Gaji --</option>
                            <option>Rp 1.000.000</option>
                        </select>
                        <button class="btn btn-primary w-100 w-sm-auto">
                            Beli Saldo Gaji
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Tanggal Order</th>
                        <th>Tanggal Bayar</th>
                        <th>Nomor Transaksi</th>
                        <th>Tipe</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
                        <th>Nominal Total</th>
                        <th>Status</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($billings as $bill)
                        <tr>
                            <td class="text-center">
                                {{ $bill->created_at->format('d M Y') }}<br>
                                <small class="text-muted">{{ $bill->created_at->format('H:i:s') }}</small>
                            </td>
                            <td class="text-center">
                                @if ($bill->tanggal_bayar)
                                    {{ $bill->tanggal_bayar->format('d M Y') }}<br>
                                    <small class="text-muted">{{ $bill->tanggal_bayar->format('H:i:s') }}</small>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $bill->nomor_transaksi }}</td>
                            <td>{{ $bill->tipe }}</td>
                            <td>Rp {{ number_format($bill->nominal, 0, ',', '.') }},-</td>
                            <td>{{ $bill->keterangan }}</td>
                            <td class="fw-bold">Rp {{ number_format($bill->nominal_total, 0, ',', '.') }},-</td>
                            <td class="text-center">
                                @if ($bill->payment_status == 'paid')
                                    <span class="badge bg-greenkit">Terbayar</span>
                                @else
                                    <span class="badge bg-danger">Belum Bayar</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($bill->file_invoice)
                                    <a href="{{ asset('storage/' . $bill->file_invoice) }}" class="btn btn-light btn-sm"
                                        target="_blank">
                                        <i class='bx bxs-file-pdf'></i>
                                    </a>
                                @else
                                    <button class="btn btn-light btn-sm disabled">
                                        <i class='bx bxs-file-pdf'></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                @if ($perusahaan->trial_ends_at && now()->lessThan($perusahaan->trial_ends_at))
                                    <em>Belum ada tagihan. Akun Anda masih dalam masa Trial hingga
                                        {{ \Carbon\Carbon::parse($perusahaan->trial_ends_at)->format('d M Y') }}.</em>
                                @else
                                    Belum ada riwayat transaksi.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggle = document.getElementById("desktopMenuToggle");
            const icon = toggle.querySelector("i");

            toggle.addEventListener("click", function() {
                document.body.classList.toggle("layout-menu-collapsed");

                icon.classList.toggle("bx-chevron-left");
                icon.classList.toggle("bx-chevron-right");
            });
        });
        document.getElementById("desktopMenuToggle").addEventListener("click", function() {
            setTimeout(() => {
                window.dispatchEvent(new Event('resize'));
            }, 300);
        });
    </script>
@endsection
