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
        <!-- Bank Info Card -->
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h4 class="mb-1 text-white fw-bold">Petunjuk Pembayaran Manual</h4>
                        <p class="mb-1 opacity-75 text-sm">Silakan lakukan transfer ke salah satu rekening di bawah ini sesuai nominal tagihan.</p>
                        <p class="mb-0 opacity-100 fw-semibold text-sm">Gunakan Nomor Transaksi sebagai berita transfer untuk mempercepat pengecekan.</p>
                    </div>
                    <div class="d-flex gap-4">
                        <div class="text-end">
                            <small class="d-block opacity-75">Bank BCA</small>
                            <span class="fw-bold">123-456-7890</span>
                            <small class="d-block opacity-75">A/N PT WorkSmart Indonesia</small>
                        </div>
                        <div class="text-end">
                            <small class="d-block opacity-75">Bank Mandiri</small>
                            <span class="fw-bold">098-765-4321</span>
                            <small class="d-block opacity-75">A/N PT WorkSmart Indonesia</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                                    <h5 class="mb-0 fw-semibold">Rp {{ number_format($perusahaan->saldo_utama, 0, ',', '.') }},-</h5>
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
                                    <h5 class="mb-0 fw-semibold">Rp {{ number_format($perusahaan->saldo_gaji, 0, ',', '.') }},-</h5>
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
                                    <h5 class="mb-0 fw-semibold">Rp {{ number_format($perusahaan->saldo_bonus, 0, ',', '.') }},-</h5>
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
                    <form action="{{ route('billing.buy-saldo') }}" method="POST" class="m-0 d-flex flex-column flex-sm-row gap-2">
                        @csrf
                        <select name="saldo" class="form-select" required>
                            <option value="">-- Pilih Saldo --</option>
                            <option>Rp.50.000,-</option>
                            <option>Rp.100.000,-</option>
                            <option>Rp.150.000,-</option>
                            <option>Rp.200.000,-</option>
                            <option>Rp.300.000,-</option>
                            <option>Rp.500.000,- Bonus Rp.200.000,- Promo Diskon 35%</option>
                            <option>Rp.750.000,- Bonus Rp.250.000,- Promo Diskon 35%</option>
                            <option>Rp.1.000.000,- Bonus Rp.300.000,- Promo Diskon 35%</option>
                            <option>Rp.1.500.000,- Bonus Rp.500.000,- Promo Diskon 35%</option>
                            <option>Rp.1.750.000,- Bonus Rp.500.000,- Promo Diskon 35%</option>
                            <option>Rp.1.850.000,- Bonus Rp.500.000,- Promo Diskon 35%</option>
                            <option>Rp.2.000.000,- Bonus Rp.500.000,- Promo Diskon 35%</option>
                            <option>Rp.2.500.000,- Bonus Rp.500.000,- Promo Diskon 35%</option>
                            <option>Rp.5.000.000,- Bonus Rp.1.000.000,- Promo Diskon 35%</option>
                        </select>
                        <button type="submit" class="btn btn-primary w-100 w-sm-auto">
                            Beli Saldo
                        </button>
                    </form>


                    <!-- Paket -->
                    <form action="{{ route('billing.buy-package') }}" method="POST" class="m-0 d-flex flex-column flex-sm-row gap-2">
                        @csrf
                        <select name="package" class="form-select" required>
                            <option value="">-- Pilih Paket Tahunan --</option>
                            <option>Paket Berlangganan 100 Pegawai - Rp 1.900.000</option>
                            <option>Paket Berlangganan 300 Pegawai - Rp 3.750.000</option>
                            <option>Paket Berlangganan 500 Pegawai - Rp 5.750.000</option>
                            <option>Paket Berlangganan 700 Pegawai - Rp 7.500.000</option>
                            <option>Paket Berlangganan 1000 Pegawai - Rp 9.250.000</option>
                        </select>
                        <button type="submit" class="btn btn-primary w-100 w-sm-auto">
                            Beli Paket
                        </button>
                    </form>

                    <!-- Saldo Gaji -->
                    <form action="{{ route('billing.buy-saldo-gaji') }}" method="POST" class="m-0 d-flex flex-column flex-sm-row gap-2">
                        @csrf
                        <select name="saldo_gaji" class="form-select" required>
                            <option value="">-- Pilih Saldo Gaji --</option>
                            <option>Rp.5.000.000,-</option>
                            <option>Rp.7.500.000,-</option>
                            <option>Rp.10.000.000,-</option>
                            <option>Rp.20.000.000,-</option>
                            <option>Rp.30.000.000,-</option>
                            <option>Rp.40.000.000,-</option>
                            <option>Rp.50.000.000,-</option>
                            <option>Rp.60.000.000,-</option>
                            <option>Rp.70.000.000,-</option>
                            <option>Rp.75.000.000,-</option>
                            <option>Rp.100.000.000,-</option>
                            <option>--- Costume Saldo Gaji ---</option>
                        </select>
                        <button type="submit" class="btn btn-primary w-100 w-sm-auto">
                            Beli Saldo Gaji
                        </button>
                    </form>

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
                                    @if ($bill->bukti_pembayaran)
                                        <br>
                                        <a href="{{ asset('storage/' . $bill->bukti_pembayaran) }}" target="_blank" class="text-xs text-primary mt-1 d-inline-block">
                                            <i class="bx bx-image-alt"></i> Lihat Bukti
                                        </a>
                                    @endif
                                @else
                                    @if ($bill->status == 'expired')
                                        <span class="badge bg-secondary">Kedaluwarsa</span>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm open-pay-modal" 
                                                data-id="{{ $bill->id }}" 
                                                data-no="{{ $bill->nomor_transaksi }}"
                                                data-nominal="Rp {{ number_format($bill->nominal_total, 0, ',', '.') }},-">
                                            Bayar Sekarang
                                        </button>
                                        <div class="mt-1">
                                            <small class="text-danger" style="font-size: 0.70rem;">
                                                Batas: {{ $bill->created_at->addDay()->format('d M y H:i') }}
                                            </small>
                                        </div>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($bill->file_invoice)
                                    <a href="{{ asset('storage/' . $bill->file_invoice) }}" class="btn btn-light btn-sm"
                                        target="_blank" title="Download Invoice">
                                        <i class='bx bxs-file-pdf'></i>
                                    </a>
                                @else
                                    <a href="{{ route('billing.invoice', $bill->id) }}" class="btn btn-light btn-sm"
                                        target="_blank" title="Cetak / Download Invoice">
                                        <i class='bx bxs-file-pdf'></i>
                                    </a>
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

    <!-- Payment Modal -->
    <div class="modal fade" id="payModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-start">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="payForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-info border-0 shadow-none mb-4">
                            <small>
                                <i class="bx bx-info-circle me-1"></i>
                                Silakan upload bukti transfer bank untuk pesanan: <strong id="modal-no-transaksi"></strong> 
                                dengan total <strong id="modal-nominal"></strong>
                            </small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Bukti Transfer</label>
                            <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*" required>
                            <small class="text-muted">Format: JPG, PNG, JPEG (Max 2MB)</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Konfirmasi Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Success/Error Alerts
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                });
            @endif

            const toggle = document.getElementById("desktopMenuToggle");
            if (toggle) {
                const icon = toggle.querySelector("i");
                toggle.addEventListener("click", function() {
                    document.body.classList.toggle("layout-menu-collapsed");
                    icon.classList.toggle("bx-chevron-left");
                    icon.classList.toggle("bx-chevron-right");
                });
            }

            // Pay Modal Handler (using delegation for robustness)
            $(document).on('click', '.open-pay-modal', function() {
                const id = $(this).data('id');
                const no = $(this).data('no');
                const nominal = $(this).data('nominal');
                
                $('#modal-no-transaksi').text(no);
                $('#modal-nominal').text(nominal);
                $('#payForm').attr('action', `/billing/pay/${id}`);
                
                const myModal = new bootstrap.Modal(document.getElementById('payModal'));
                myModal.show();
            });
        });
    </script>
@endsection
