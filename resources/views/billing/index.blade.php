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
        $totalTagihan = $daysLeft === 0 ? $jumlahPegawai * $biayaPerPegawai : 0;
    @endphp
    <div class="row g-4 mb-4">
        <!-- Bank Info Card -->
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h4 class="mb-1 text-white fw-bold">Petunjuk Pembayaran Manual</h4>
                        <p class="mb-1 opacity-75 text-sm">Silakan lakukan transfer ke salah satu rekening di bawah ini
                            sesuai nominal tagihan.</p>
                        <p class="mb-0 opacity-100 fw-semibold text-sm">Gunakan Nomor Transaksi sebagai berita transfer
                            untuk mempercepat pengecekan.</p>
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
                                    <h5 class="mb-0 fw-semibold">Rp
                                        {{ number_format($perusahaan->saldo_utama, 0, ',', '.') }},-
                                    </h5>
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
                                    <h5 class="mb-0 fw-semibold">Rp
                                        {{ number_format($perusahaan->saldo_gaji, 0, ',', '.') }},-
                                    </h5>
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
                                    <h5 class="mb-0 fw-semibold">Rp
                                        {{ number_format($perusahaan->saldo_bonus, 0, ',', '.') }},-
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-3 d-flex flex-column gap-2">

                    <form action="{{ route('billing.buy-saldo') }}" method="POST" class="d-flex gap-2 m-0">
                        @csrf
                        <select name="saldo" class="form-select form-select-sm w-75" id="selectSaldo" required>
                            <option value="">-- Pilih Saldo --</option>
                            <option value="50000" data-bonus="0">Rp.50.000,-</option>
                            <option value="100000" data-bonus="0">Rp.100.000,-</option>
                            <option value="150000" data-bonus="0">Rp.150.000,-</option>
                            <option value="200000" data-bonus="0">Rp.200.000,-</option>
                            <option value="300000" data-bonus="0">Rp.30.000,-</option>
                            <option value="500000" data-bonus="200000">Rp.500.000,- Bonus Rp.200.000,-</option>
                            <option value="750000" data-bonus="250000">Rp.750.000,- Bonus Rp.250.000,-</option>
                            <option value="1000000" data-bonus="300000">Rp.1.000.000,- Bonus Rp.300.000,-</option>
                            <option value="1500000" data-bonus="500000">Rp.1.500.000,- Bonus Rp.500.000,-</option>
                            <option value="1750000" data-bonus="500000">Rp.1.750.000,- Bonus Rp.500.000,-</option>
                            <option value="1850000" data-bonus="500000">Rp.1.850.000,- Bonus Rp.500.000,-</option>
                            <option value="2000000" data-bonus="500000">Rp.2.000.000,- Bonus Rp.500.000,-</option>
                            <option value="2500000" data-bonus="500000">Rp.2.500.000,- Bonus Rp.500.000,-</option>
                            <option value="5000000" data-bonus="1000000">Rp.5.000.000,- Bonus Rp.1.000.000,-</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm px-3 w-50" id="btnBeliSaldo">Beli Saldo</button>
                    </form>

                    <form action="{{ route('billing.buy-package') }}" method="POST" class="d-flex gap-2 m-0">
                        @csrf
                        <select name="package" class="form-select form-select-sm w-75" id="selectPaket" required>
                            <option value="">-- Pilih Paket Tahunan --</option>
                            <option value="1900000" data-label="Paket Berlangganan 100 Pegawai" data-durasi="365">Paket
                                Berlangganan 100 Pegawai - Rp 1.900.000</option>
                            <option value="3750000" data-label="Paket Berlangganan 300 Pegawai" data-durasi="365">Paket
                                Berlangganan 300 Pegawai - Rp 3.750.000</option>
                            <option value="5750000" data-label="Paket Berlangganan 500 Pegawai" data-durasi="365">Paket
                                Berlangganan 500 Pegawai - Rp 5.750.000</option>
                            <option value="7500000" data-label="Paket Berlangganan 700 Pegawai" data-durasi="365">Paket
                                Berlangganan 700 Pegawai - Rp 7.500.000</option>
                            <option value="9250000" data-label="Paket Berlangganan 1000 Pegawai" data-durasi="365">Paket
                                Berlangganan 1000 Pegawai - Rp 9.250.000</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm px-3 w-50" id="btnBeliPaket">Beli Paket</button>
                    </form>

                    <div class="d-flex flex-column gap-2 m-0">
                        <form action="{{ route('billing.buy-saldo-gaji') }}" method="POST" class="d-flex flex-column gap-2 m-0">
                            @csrf
                            <div class="d-flex gap-2">
                                <select name="saldo_gaji" class="form-select form-select-sm w-75" id="selectGaji" required>
                                    <option value="">-- Pilih Saldo Gaji --</option>
                                    <option value="5000000">Rp.5.000.000,-</option>
                                    <option value="7500000">Rp.7.500.000,-</option>
                                    <option value="10000000">Rp.10.000.000,-</option>
                                    <option value="20000000">Rp.20.000.000,-</option>
                                    <option value="30000000">Rp.30.000.000,-</option>
                                    <option value="40000000">Rp.40.000.000,-</option>
                                    <option value="50000000">Rp.50.000.000,-</option>
                                    <option value="60000000">Rp.60.000.000,-</option>
                                    <option value="70000000">Rp.70.000.000,-</option>
                                    <option value="75000000">Rp.75.000.000,-</option>
                                    <option value="100000000">Rp.100.000.000,-</option>
                                    <option value="costume">--- Input Manual ---</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm px-3 w-50" id="btnBeliGaji">Beli Saldo Gaji</button>
                            </div>
                            <div id="inputGajiCustom" class="d-none">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="custom_nominal" id="nominalGajiCustom" class="form-control"
                                        placeholder="Masukkan nominal...">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-body pt-2">
            <ul class="nav nav-tabs mb-3 border-bottom" id="billingTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="utama-tab" data-bs-toggle="tab" data-bs-target="#utama"
                        type="button">
                        Saldo Utama
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="gaji-tab" data-bs-toggle="tab" data-bs-target="#gaji" type="button">
                        Saldo Gaji
                    </button>
                </li>
            </ul>
            <div class="tab-content pt-2 ps-0 pe-0 pb-0">
                <div class="tab-pane fade show active" id="utama">
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $utamaBillings = $billings->filter(fn($b) => $b->tipe !== 'Topup Saldo Gaji');
                                @endphp
                                @forelse($utamaBillings as $bill)
                                    <tr>
                                        <!-- ... (existing row content for utama) ... -->
                                        <td class="text-center">
                                            {{ $bill->created_at->format('d M Y') }}<br>
                                            <small class="text-muted">{{ $bill->created_at->format('H:i:s') }}</small>
                                        </td>
                                        <td class="text-center">
                                            @if ($bill->tanggal_bayar)
                                                {{ $bill->tanggal_bayar->format('d M Y') }}<br>
                                                <small
                                                    class="text-muted">{{ $bill->tanggal_bayar->format('H:i:s') }}</small>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $bill->nomor_transaksi }}</td>
                                        <td>{{ $bill->tipe }}</td>
                                        <td>Rp {{ number_format($bill->nominal, 0, ',', '.') }},-</td>
                                        <td>{{ $bill->keterangan }}</td>
                                        <td class="fw-bold">Rp {{ number_format($bill->nominal_total, 0, ',', '.') }},-
                                        </td>
                                        <td class="text-center">
                                            @if ($bill->payment_status == 'paid')
                                                <span class="badge bg-primary">Terbayar</span>
                                                @if ($bill->bukti_pembayaran)
                                                    <br>
                                                    <a href="{{ asset('storage/' . $bill->bukti_pembayaran) }}"
                                                        target="_blank" class="text-xs text-primary mt-1 d-inline-block">
                                                        <i class="bx bx-image-alt"></i> Lihat Bukti
                                                    </a>
                                                @endif
                                            @elseif ($bill->payment_status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                                @if ($bill->bukti_pembayaran)
                                                    <br>
                                                    <a href="{{ asset('storage/' . $bill->bukti_pembayaran) }}"
                                                        target="_blank" class="text-xs text-primary mt-1 d-inline-block">
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
                                            <a href="{{ route('billing.invoice', $bill->id) }}"
                                                class="btn btn-light btn-sm" target="_blank text-decoration-none"
                                                title="Cetak / Download Invoice">
                                                <i class='bx bxs-file-pdf'></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4 text-muted">
                                            Belum ada riwayat transaksi Saldo Utama.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="gaji">
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $gajiBillings = $billings->filter(fn($b) => $b->tipe === 'Topup Saldo Gaji');
                                @endphp
                                @forelse($gajiBillings as $bill)
                                    <tr>
                                        <td class="text-center">
                                            {{ $bill->created_at->format('d M Y') }}<br>
                                            <small class="text-muted">{{ $bill->created_at->format('H:i:s') }}</small>
                                        </td>
                                        <td class="text-center">
                                            @if ($bill->tanggal_bayar)
                                                {{ $bill->tanggal_bayar->format('d M Y') }}<br>
                                                <small
                                                    class="text-muted">{{ $bill->tanggal_bayar->format('H:i:s') }}</small>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $bill->nomor_transaksi }}</td>
                                        <td>{{ $bill->tipe }}</td>
                                        <td>Rp {{ number_format($bill->nominal, 0, ',', '.') }},-</td>
                                        <td>{{ $bill->keterangan }}</td>
                                        <td class="fw-bold">Rp {{ number_format($bill->nominal_total, 0, ',', '.') }},-
                                        </td>
                                        <td class="text-center">
                                            @if ($bill->payment_status == 'paid')
                                                <span class="badge bg-primary">Terbayar</span>
                                            @elseif ($bill->payment_status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @else
                                                <button type="button" class="btn btn-danger btn-sm open-pay-modal"
                                                    data-id="{{ $bill->id }}"
                                                    data-no="{{ $bill->nomor_transaksi }}"
                                                    data-nominal="Rp {{ number_format($bill->nominal_total, 0, ',', '.') }},-">
                                                    Bayar Sekarang
                                                </button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('billing.invoice', $bill->id) }}"
                                                class="btn btn-light btn-sm" target="_blank"
                                                title="Cetak / Download Invoice">
                                                <i class='bx bxs-file-pdf'></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4 text-muted">
                                            Belum ada riwayat transaksi Saldo Gaji.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="payModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header d-flex justify-content-between align-items-center border-0 pb-0">
                    <h5 class="modal-title fw-bold text-secondary" style="font-size: 1.1rem;">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="payForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pt-2 text-start">
                        <div class="text-center mb-4">
                            <span class="text-muted d-block mb-1" style="font-size: 0.9rem;">Nominal Pembelian</span>
                            <h3 class="fw-bold mb-0" id="modal-nominal" style="color: #4CAF50;"></h3>
                            <small class="text-muted" id="modal-no-transaksi" style="display: none;"></small>
                        </div>

                        <div class="card bg-light border-0 mb-4" style="border-radius: 8px;">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bx bxs-info-circle text-secondary me-2"></i>
                                    <strong class="text-secondary" style="font-size: 0.9rem;">Instruksi
                                        Pembayaran</strong>
                                </div>
                                <p class="text-muted mb-1" style="font-size: 0.85rem;">Silakan transfer sesuai nominal ke
                                    rekening berikut:</p>
                                <div class="mb-1" style="font-size: 0.85rem;">
                                    <strong class="text-secondary">Bank Mandiri: 098-765-4321</strong>
                                </div>
                                <div style="font-size: 0.85rem;">
                                    <span class="text-muted">A/N: </span>
                                    <strong class="text-secondary">PT WorkSmart Indonesia</strong>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <span class="text-secondary fw-bold" style="font-size: 0.8rem; letter-spacing: 0.5px;">UNGGAH
                                BUKTI TRANSFER</span>
                        </div>
                        <div class="mb-2">
                            <input type="file" id="bukti_pembayaran" name="bukti_pembayaran"
                                class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp" required
                                style="border-radius: 6px;">
                        </div>
                        <div>
                            <small class="text-muted" style="font-size: 0.8rem;">Format: JPG, PNG, WEBP. Maks 2MB.</small>
                        </div>
                    </div>
                    <div class="modal-footer border-0 d-flex justify-content-between pt-0 pb-3">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal"
                            style="background: #e9ecef; color: #495057; font-weight: 500;">Batal</button>
                        <button type="submit" class="btn text-white px-4"
                            style="background-color: #4CAF50; font-weight: 500;">Konfirmasi Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Success/Error Alerts
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
            @if (session('error'))
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

            // Toggle Custom Saldo Gaji Input
            const selectGaji = document.getElementById('selectGaji');
            const inputGajiCustom = document.getElementById('inputGajiCustom');
            const nominalGajiCustom = document.getElementById('nominalGajiCustom');

            if (selectGaji) {
                selectGaji.addEventListener('change', function() {
                    if (this.value === 'costume') {
                        inputGajiCustom.classList.remove('d-none');
                        nominalGajiCustom.setAttribute('required', 'required');
                    } else {
                        inputGajiCustom.classList.add('d-none');
                        nominalGajiCustom.removeAttribute('required');
                    }
                });
            }
        });
    </script>
@endsection
