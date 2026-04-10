@extends('layouts.app')

@section('title', 'Data Billing | Superadmin')

@section('content')
    <style>
        .nav-pills .nav-link {
            border-radius: 6px;
            font-weight: 500;
        }

        .nav-pills .nav-link.active {
            background-color: #3CC382 !important;
            box-shadow: 0 2px 4px rgba(60, 195, 130, 0.3);
        }

        .metric-icon {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
        }

        .table-filter-bar {
            background-color: #f8f9fa;
            border-radius: 6px;
            border: 1px solid #e9ecef;
        }

        .btn-outline-green {
            border-color: #3CC382;
            color: #3CC382;
        }

        .btn-outline-green:hover {
            background-color: #3CC382;
            color: #fff;
        }
    </style>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- TABS Navigation -->
    <div class="bg-white p-2 rounded shadow-sm mb-4 d-flex align-items-center">
        <ul class="nav nav-pills m-0 border-0" id="billingTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active px-4 py-2 me-2" id="list-billing-tab" data-bs-toggle="pill"
                    data-bs-target="#list-billing" type="button" role="tab">
                    <i class='bx bx-check-circle me-1'></i> List Billing
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link color-white" id="list-tagihan-tab" data-bs-toggle="pill"
                    data-bs-target="#list-tagihan" type="button" role="tab">
                    <i class='bx bx-receipt me-1'></i> List Tagihan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link color-white" id="voucher-tab" data-bs-toggle="pill" data-bs-target="#voucher"
                    type="button" role="tab">
                    <i class='bx bx-purchase-tag me-1'></i> Voucher
                </button>
            </li>
        </ul>
    </div>

    <div class="tab-content p-0 border-0 bg-transparent shadow-none" id="billingTabsContent">
        <!-- TAB: LIST BILLING -->
        <div class="tab-pane fade show active" id="list-billing" role="tabpanel">

            <!-- METRIC CARDS -->
            <div class="row g-3 mb-4">
                <!-- Baris 1 -->
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 text-center py-2 rounded-3">
                        <div class="card-body">
                            <div class="metric-icon" style="background-color: #E6F7ED; color: #3CC382;">
                                <i class='bx bx-wallet fs-5'></i>
                            </div>
                            <span class="d-block text-muted mb-1" style="font-size: 0.8rem;">Total Saldo Tanpa Bonus</span>
                            <h5 class="fw-bolder text-dark mb-0">Rp {{ number_format($totalSaldo, 0, ',', '.') }},-</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 text-center py-2 rounded-3">
                        <div class="card-body">
                            <div class="metric-icon" style="background-color: #F1F3F5; color: #ADB5BD;">
                                <i class='bx bx-gift fs-5'></i>
                            </div>
                            <span class="d-block text-muted mb-1" style="font-size: 0.8rem;">Total bonus keluar</span>
                            <h5 class="fw-bolder text-dark mb-0">Rp {{ number_format($totalBonus, 0, ',', '.') }},-</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 text-center py-2 rounded-3">
                        <div class="card-body">
                            <div class="metric-icon" style="background-color: #E8F4FA; color: #4FA8D6;">
                                <i class='bx bx-calendar fs-5'></i>
                            </div>
                            <span class="d-block text-muted mb-1" style="font-size: 0.8rem;">Saldo Bulan Ini</span>
                            <h5 class="fw-bolder text-dark mb-0">Rp {{ number_format($saldoBulanIni, 0, ',', '.') }},-</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 text-center py-2 rounded-3">
                        <div class="card-body">
                            <div class="metric-icon" style="background-color: #FFF4E5; color: #FFB347;">
                                <i class='bx bx-gift fs-5'></i>
                            </div>
                            <span class="d-block text-muted mb-1" style="font-size: 0.8rem;">Bonus Bulan Ini</span>
                            <h5 class="fw-bolder text-dark mb-0">Rp {{ number_format($bonusBulanIni, 0, ',', '.') }},-</h5>
                        </div>
                    </div>
                </div>

                <!-- Baris 2 -->
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 text-center py-2 rounded-3">
                        <div class="card-body">
                            <div class="metric-icon" style="background-color: #E6F7ED; color: #3CC382;">
                                <i class='bx bx-time-five fs-5'></i>
                            </div>
                            <span class="d-block text-muted mb-1" style="font-size: 0.8rem;">Saldo Hari Ini</span>
                            <h5 class="fw-bolder text-dark mb-0">Rp {{ number_format($saldoHariIni, 0, ',', '.') }},-</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 text-center py-2 rounded-3">
                        <div class="card-body">
                            <div class="metric-icon" style="background-color: #E8F4FA; color: #4FA8D6;">
                                <i class='bx bx-gift fs-5'></i>
                            </div>
                            <span class="d-block text-muted mb-1" style="font-size: 0.8rem;">Bonus Hari Ini</span>
                            <h5 class="fw-bolder text-dark mb-0">Rp {{ number_format($bonusHariIni, 0, ',', '.') }},-</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 text-center py-2 rounded-3">
                        <div class="card-body">
                            <div class="metric-icon" style="background-color: #FCEAEA; color: #EC6C6C;">
                                <i class='bx bx-line-chart fs-5'></i>
                            </div>
                            <span class="d-block text-muted mb-1" style="font-size: 0.8rem;">Saldo 7 Hari Terakhir</span>
                            <h5 class="fw-bolder text-dark mb-0">Rp {{ number_format($saldo7Hari, 0, ',', '.') }},-</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-sm border-0 h-100 text-center py-2 rounded-3">
                        <div class="card-body">
                            <div class="metric-icon" style="background-color: #F1F3F5; color: #8C98A4;">
                                <i class='bx bx-star fs-5'></i>
                            </div>
                            <span class="d-block text-muted mb-1" style="font-size: 0.8rem;">Bonus 7 Hari Terakhir</span>
                            <h5 class="fw-bolder text-dark mb-0">Rp {{ number_format($bonus7Hari, 0, ',', '.') }},-</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GRAFIK PENDAPATAN -->
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-header bg-light border-0 text-center py-3 rounded-top-3"
                    style="background-color: #E2E3E5 !important;">
                    <h6 class="mb-0 fw-bold text-secondary">Grafik Pendapatan Tiap Bulan</h6>
                </div>
                <div class="card-body px-4 py-4">
                    <canvas id="revenueChart" height="90"></canvas>
                </div>
            </div>

            <!-- TABEL DATA -->
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div
                    class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <h5 class="mb-0 fw-bold text-dark">List Billing</h5>

                    <form action="{{ route('superadmin.billing.index') }}" method="GET"
                        class="d-flex align-items-center gap-2 m-0 flex-wrap">
                        <div class="input-group input-group-sm w-auto">
                            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                        </div>
                        <div class="input-group input-group-sm border rounded" style="width: 200px;">
                            <input type="text" name="search" class="form-control border-0"
                                placeholder="Cari Data..." value="{{ request('search') }}">
                        </div>
                        <div class="input-group input-group-sm w-auto">
                            <select name="perusahaan_id" class="form-select text-secondary">
                                <option value="">Nama Perusahaan</option>
                                @foreach ($perusahaanList as $p)
                                    <option value="{{ $p->id }}"
                                        {{ request('perusahaan_id') == $p->id ? 'selected' : '' }}>
                                        {{ $p->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-outline-green btn-sm px-4">Cari</button>
                        @if (request('search') || request('perusahaan_id') || request('date'))
                            <a href="{{ route('superadmin.billing.index') }}"
                                class="btn btn-light btn-sm text-muted">Clear</a>
                        @endif
                    </form>
                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #E2E3E5;">
                            <tr>
                                <th class="text-secondary fw-semibold py-3 border-0">PERUSAHAAN</th>
                                <th class="text-secondary fw-semibold py-3 border-0">INVOICE</th>
                                <th class="text-secondary fw-semibold py-3 border-0">ORDER</th>
                                <th class="text-secondary fw-semibold py-3 border-0">BAYAR</th>
                                <th class="text-secondary fw-semibold py-3 border-0 text-center">STATUS</th>
                                <th class="text-secondary fw-semibold py-3 border-0">ORDER TGL</th>
                                <th class="text-secondary fw-semibold py-3 border-0 text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @forelse($billings as $bill)
                                <tr>
                                    <td class="align-middle border-bottom">
                                        <div class="d-flex align-items-center">
                                            @if ($bill->perusahaan && $bill->perusahaan->logo)
                                                <img src="{{ asset('storage/' . $bill->perusahaan->logo) }}"
                                                    class="rounded-circle me-2" width="30" height="30"
                                                    alt="">
                                            @else
                                                <div class="rounded-circle bg-light d-flex justify-content-center align-items-center me-2"
                                                    style="width: 30px; height: 30px;">
                                                    <i class='bx bx-buildings text-muted' style="font-size: 14px;"></i>
                                                </div>
                                            @endif
                                            <span
                                                class="fw-medium text-dark">{{ $bill->perusahaan ? $bill->perusahaan->nama_perusahaan : '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="align-middle border-bottom">{{ $bill->nomor_transaksi }}</td>
                                    <td class="align-middle border-bottom">
                                        {{ $bill->tipe }}<br>
                                        <small class="text-muted">Rp
                                            {{ number_format($bill->nominal_total, 0, ',', '.') }},-</small>
                                    </td>
                                    <td class="align-middle border-bottom">
                                        @if ($bill->payment_status === 'paid' || $bill->payment_status === 'pending')
                                            Rp {{ number_format($bill->nominal_total, 0, ',', '.') }},-
                                        @else
                                            Rp 0,-
                                        @endif
                                    </td>
                                    <td class="align-middle border-bottom text-center">
                                        @if ($bill->payment_status === 'pending')
                                            <span class="badge"
                                                style="background-color: #FFF4E5; color: #FFB347;">Pending</span>
                                        @elseif($bill->payment_status === 'paid')
                                            <span class="badge"
                                                style="background-color: #E6F7ED; color: #3CC382;">Selesai</span>
                                        @else
                                            @if ($bill->status === 'expired')
                                                <span class="badge bg-secondary">Expired</span>
                                            @else
                                                <span class="badge bg-danger">Unpaid</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="align-middle border-bottom text-muted">
                                        {{ $bill->created_at->format('d M Y') }}</td>
                                    <td class="align-middle border-bottom text-center">
                                        @if ($bill->payment_status === 'pending')
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                data-bs-target="#approveModal{{ $bill->id }}"
                                                style="background-color: #3CC382; border: none;">
                                                Terima<br>Pembayaran
                                            </button>

                                            <!-- Approve Modal -->
                                            <div class="modal fade" id="approveModal{{ $bill->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content text-start">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title fw-bold">Konfirmasi Pembayaran</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-wrap pt-0">
                                                            Apakah Anda yakin ingin menyetujui pembayaran Invoice
                                                            <strong>{{ $bill->nomor_transaksi }}</strong> dari
                                                            <strong>{{ $bill->perusahaan ? $bill->perusahaan->nama_perusahaan : '-' }}</strong>
                                                            sejumlah <strong>Rp
                                                                {{ number_format($bill->nominal_total, 0, ',', '.') }},-</strong>?<br><br>
                                                            Tindakan ini akan memproses pesanan dan mencatat saldo/paket
                                                            baru.
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <form
                                                                action="{{ route('superadmin.billing.approve', $bill->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success"
                                                                    style="background-color: #3CC382; border: 0;">Ya,
                                                                    Setujui</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($bill->bukti_pembayaran)
                                            <a href="{{ asset('storage/' . $bill->bukti_pembayaran) }}" target="_blank"
                                                class="btn btn-sm btn-light border" title="Lihat Bukti Transfer">
                                                <i class='bx bx-image'></i> Bukti
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">Belum ada data billing
                                        terbayar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($billings->hasPages())
                    <div class="card-footer bg-white border-top-0 d-flex justify-content-center">
                        {{ $billings->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>

        </div>
        <!-- TAB: LIST TAGIHAN -->
        <div class="tab-pane fade" id="list-tagihan" role="tabpanel">
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div
                    class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <h5 class="mb-0 fw-bold text-dark">List Tagihan</h5>

                    <form action="{{ route('superadmin.billing.index') }}" method="GET"
                        class="d-flex align-items-center gap-2 m-0 flex-wrap">
                        <div class="input-group input-group-sm border rounded" style="width: 250px;">
                            <input type="text" name="search" class="form-control border-0"
                                placeholder="Cari Data..." value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="btn btn-outline-green btn-sm px-4">Cari</button>
                    </form>
                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #E2E3E5;">
                            <tr>
                                <th class="text-secondary fw-semibold py-3 border-0">PERUSAHAAN</th>
                                <th class="text-secondary fw-semibold py-3 border-0">TANGGAL</th>
                                <th class="text-secondary fw-semibold py-3 border-0">INVOICE</th>
                                <th class="text-secondary fw-semibold py-3 border-0">TIPE</th>
                                <th class="text-secondary fw-semibold py-3 border-0">NOMINAL</th>
                                <th class="text-secondary fw-semibold py-3 border-0 text-center">STATUS</th>
                                <th class="text-secondary fw-semibold py-3 border-0 text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @forelse($billings as $bill)
                                <tr>
                                    <td class="align-middle border-bottom fw-bold text-dark">
                                        {{ $bill->perusahaan ? $bill->perusahaan->nama_perusahaan : '-' }}</td>
                                    <td class="align-middle border-bottom text-muted">
                                        {{ $bill->created_at->format('d M Y') }}</td>
                                    <td class="align-middle border-bottom">{{ $bill->nomor_transaksi }}</td>
                                    <td class="align-middle border-bottom">{{ $bill->tipe }}</td>
                                    <td class="align-middle border-bottom">Rp
                                        {{ number_format($bill->nominal_total, 0, ',', '.') }},-</td>
                                    <td class="align-middle border-bottom text-center">
                                        @if ($bill->payment_status === 'paid')
                                            <span class="badge"
                                                style="background-color: #3CC382; color: #fff;">Selesai</span>
                                        @elseif($bill->payment_status === 'pending')
                                            <span class="badge"
                                                style="background-color: #FFF4E5; color: #FFB347;">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="align-middle border-bottom text-center">
                                        <button type="button" class="btn btn-sm btn-success open-detail-billing"
                                            data-id="{{ $bill->id }}" data-no="{{ $bill->nomor_transaksi }}"
                                            data-perusahaan="{{ $bill->perusahaan ? $bill->perusahaan->nama_perusahaan : '-' }}"
                                            data-tipe="{{ $bill->tipe }}"
                                            data-total="Rp {{ number_format($bill->nominal_total, 0, ',', '.') }}"
                                            data-tanggal="{{ $bill->created_at->format('d M Y H:i') }}"
                                            data-status="{{ $bill->payment_status }}"
                                            data-keterangan="{{ $bill->keterangan }}"
                                            data-bukti="{{ $bill->bukti_pembayaran ? asset('storage/' . $bill->bukti_pembayaran) : '' }}"
                                            style="background-color: #3CC382; border: none; font-size: 11px; padding: 4px 10px;">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">Belum ada data tagihan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- TAB: VOUCHER -->
        <div class="tab-pane fade" id="voucher" role="tabpanel">
            <div class="row g-4">
                <!-- KIRI: FORM INPUT -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-header bg-light border-0 py-3 rounded-top-3"
                            style="background-color: #E2E3E5 !important;">
                            <h6 class="mb-0 fw-bold text-secondary">Input Voucher</h6>
                        </div>
                        <div class="card-body py-4">
                            <form action="{{ route('superadmin.voucher.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-bold small">NAMA VOUCHER</label>
                                    <input type="text" name="nama" class="form-control"
                                        placeholder="Contoh: Promo Ramadhan" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-bold small">KODE VOUCHER</label>
                                    <input type="text" name="kode" class="form-control" placeholder="Promo123"
                                        required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-secondary fw-bold small">KUOTA</label>
                                        <input type="number" name="kuota" class="form-control" placeholder="10"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-secondary fw-bold small">NOMINAL (Rp)</label>
                                        <input type="number" name="nominal" class="form-control" placeholder="50000"
                                            required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-secondary fw-bold small">TIPE</label>
                                        <select name="tipe" class="form-select">
                                            <option value="saldo">Saldo</option>
                                            <option value="persen">Persen</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-secondary fw-bold small">STATUS</label>
                                        <select name="status" class="form-select">
                                            <option value="aktif">Aktif</option>
                                            <option value="nonaktif">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-secondary fw-bold small">DESKRIPSI</label>
                                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Isi deskripsi voucher..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-success w-100 py-2"
                                    style="background-color: #3CC382; border: none; font-weight: 600;">Simpan
                                    Voucher</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- KANAN: TABEL LIST -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div
                            class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-end flex-wrap gap-3">
                            <div class="input-group input-group-sm border rounded" style="width: 250px;">
                                <input type="text" id="voucherSearch" class="form-control border-0"
                                    placeholder="Cari Data...">
                            </div>
                            <button class="btn btn-outline-green btn-sm px-4">Cari</button>
                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover mb-0">
                                <thead style="background-color: #E2E3E5;">
                                    <tr>
                                        <th class="text-secondary fw-semibold py-3 border-0">VOUCHER</th>
                                        <th class="text-secondary fw-semibold py-3 border-0 text-center">STATUS</th>
                                        <th class="text-secondary fw-semibold py-3 border-0 text-center">KUOTA</th>
                                        <th class="text-secondary fw-semibold py-3 border-0">TIPE</th>
                                        <th class="text-secondary fw-semibold py-3 border-0 text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody class="border-top-0">
                                    @forelse($vouchers as $v)
                                        <tr>
                                            <td class="align-middle border-bottom fw-bold text-dark">{{ $v->kode }}
                                            </td>
                                            <td class="align-middle border-bottom text-center">
                                                <span class="badge"
                                                    style="background-color: {{ $v->status === 'aktif' ? '#E6F7ED' : '#FCEAEA' }}; color: {{ $v->status === 'aktif' ? '#3CC382' : '#EC6C6C' }};">
                                                    {{ $v->status }}
                                                </span>
                                            </td>
                                            <td class="align-middle border-bottom text-center">{{ $v->kuota }}</td>
                                            <td class="align-middle border-bottom">{{ $v->tipe }}</td>
                                            <td class="align-middle border-bottom text-center">
                                                <form action="{{ route('superadmin.voucher.delete', $v->id) }}"
                                                    method="POST" onsubmit="return confirm('Hapus voucher ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link text-danger p-0">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">Belum ada voucher.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Tagihan -->
    <div class="modal fade" id="detailTagihanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold">Detail Tagihan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Nomor Transaksi</label>
                        <h6 class="fw-bold text-dark mb-0" id="detail-no">-</h6>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Perusahaan</label>
                        <h6 class="fw-bold text-dark mb-0" id="detail-perusahaan">-</h6>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Nominal</label>
                        <h5 class="fw-bold text-success mb-0" id="detail-total">-</h5>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Keterangan</label>
                        <p class="text-secondary mb-0" id="detail-keterangan">-</p>
                    </div>
                    <div class="mb-0">
                        <label class="text-muted small d-block mb-2">Bukti Pembayaran</label>
                        <div id="bukti-container" class="p-4 rounded border text-center"
                            style="background-color: #FFF8E1; border-color: #FFE082 !important;">
                            <p class="text-warning mb-0" id="bukti-placeholder">Belum ada bukti transfer.</p>
                            <img id="bukti-image" src="" class="img-fluid rounded d-none"
                                style="max-height: 300px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-between align-items-center">
                    <form id="rejectForm" action="" method="POST" class="m-0 d-none">
                        @csrf
                        <button type="submit" class="btn btn-link text-secondary p-0 text-decoration-none"
                            onclick="return confirm('Tolak pembayaran ini?')">Tolak</button>
                    </form>
                    <div class="d-flex gap-2 ms-auto">
                        <button type="button" class="btn btn-secondary border-0 text-dark px-4" data-bs-dismiss="modal"
                            style="background-color: #DDE1E6;">Close</button>
                        <form id="approveForm" action="" method="POST" class="m-0 d-none">
                            @csrf
                            <button type="submit" class="btn btn-success px-4"
                                style="background-color: #3CC382; border: none;">Konfirmasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Injection -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartLabels ?? []) !!},
                        datasets: [{
                            label: 'Pendapatan',
                            data: {!! json_encode($chartData ?? []) !!},
                            borderColor: '#3CC382',
                            backgroundColor: 'rgba(60, 195, 130, 0.1)',
                            borderWidth: 2,
                            pointBackgroundColor: '#3CC382',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed.y !== null) {
                                            let value = context.parsed.y;
                                            // Format id-ID
                                            label += 'Rp ' + value.toString().replace(
                                                /\B(?=(\d{3})+(?!\d))/g, ".");
                                        }
                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                border: {
                                    display: false
                                },
                                grid: {
                                    color: '#E9ECEF'
                                },
                                ticks: {
                                    color: '#ADB5BD',
                                    callback: function(value, index, values) {
                                        if (value === 0) return '0';
                                        if (value >= 1000000) return (value / 1000000) + 'jt';
                                        if (value >= 1000) return (value / 1000) + 'rb';
                                        return value;
                                    }
                                }
                            },
                            x: {
                                border: {
                                    display: false
                                },
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#6C757D',
                                    maxRotation: 25,
                                    minRotation: 25
                                }
                            }
                        }
                    }
                });
            }
            // Handle Detail Modal for List Tagihan
            const detailModal = new bootstrap.Modal(document.getElementById('detailTagihanModal'));
            $(document).on('click', '.open-detail-billing', function() {
                const id = $(this).data('id');
                const no = $(this).data('no');
                const perusahaan = $(this).data('perusahaan');
                const total = $(this).data('total');
                const keterangan = $(this).data('keterangan');
                const status = $(this).data('status');
                const bukti = $(this).data('bukti');

                $('#detail-no').text(no);
                $('#detail-perusahaan').text(perusahaan);
                $('#detail-total').text(total);
                $('#detail-keterangan').text(keterangan || '-');

                // Bukti Pembayaran preview
                const buktiImage = $('#bukti-image');
                const buktiPlaceholder = $('#bukti-placeholder');
                const buktiContainer = $('#bukti-container');

                if (bukti) {
                    buktiImage.attr('src', bukti).removeClass('d-none');
                    buktiPlaceholder.addClass('d-none');
                    buktiContainer.css('background-color', '#fff');
                } else {
                    buktiImage.addClass('d-none');
                    buktiPlaceholder.removeClass('d-none');
                    buktiContainer.css('background-color', '#FFF8E1');
                }

                // Show/Hide action buttons based on pending status
                if (status === 'pending') {
                    $('#rejectForm').removeClass('d-none').attr('action',
                        `/superadmin/billing/${id}/reject`);
                    $('#approveForm').removeClass('d-none').attr('action',
                        `/superadmin/billing/${id}/approve`);
                } else {
                    $('#rejectForm').addClass('d-none');
                    $('#approveForm').addClass('d-none');
                }

                detailModal.show();
            });
        });
    </script>
@endsection
