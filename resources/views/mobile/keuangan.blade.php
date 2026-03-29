@extends('layouts.mobile')

@section('title', 'Keuangan')

@section('content')
    <div class="mobile-header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/img/avatars/1.png') }}" alt="Avatar"
                class="rounded-circle border border-2 border-white" style="width: 35px; height: 35px; background: white;">
            <span class="h5 mb-0 text-white fw-bold">Keuangan</span>
        </div>
        <div class="dropdown">
            <button class="btn p-0 text-white" type="button" data-bs-toggle="dropdown">
                <i class='bx bx-dots-vertical-rounded fs-4'></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.close();">Exit</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs nav-fill bg-white border-bottom" id="keuanganTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold text-uppercase py-3" id="slip-tab" data-bs-toggle="tab"
                data-bs-target="#slip-content" type="button" role="tab" aria-controls="slip-content"
                aria-selected="true" style="font-size: 0.8rem; letter-spacing: 0.5px;">Slip Gaji</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold text-uppercase py-3" id="reimbursement-tab" data-bs-toggle="tab"
                data-bs-target="#reimbursement-content" type="button" role="tab" aria-controls="reimbursement-content"
                aria-selected="false" style="font-size: 0.8rem; letter-spacing: 0.5px;">Reimbursement</button>
        </li>
    </ul>

    <div class="tab-content container-fluid py-3" id="keuanganTabsContent">
        <!-- SLIP GAJI TAB -->
        <div class="tab-pane fade show active" id="slip-content" role="tabpanel" aria-labelledby="slip-tab">
            @php
                $slips = [
                    ['month' => 'Desember 2025', 'amount' => '802.001', 'date' => '01-12-2025'],
                    ['month' => 'Oktober 2025', 'amount' => '352.000', 'date' => '01-10-2025'],
                    ['month' => 'Juni 2025', 'amount' => '2.622.000', 'date' => '01-06-2025'],
                    ['month' => 'Mei 2025', 'amount' => '29.482.000', 'date' => '01-05-2025'],
                    ['month' => 'April 2025', 'amount' => '2.792.000', 'date' => '01-04-2025'],
                ];
            @endphp

            @foreach ($slips as $slip)
                <div class="card mb-3 border-0 shadow-sm"
                    style="border-radius: 12px; overflow: hidden; background-color: #fdfbff;"
                    onclick="showSlipDetail('{{ $slip['month'] }}', '{{ $slip['date'] }}', '{{ $slip['amount'] }}')">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="rounded-3 p-1 me-3 d-flex align-items-center justify-content-center"
                            style="background-color: #e8f5e9; width: 70px; height: 70px;">
                            <img src="https://img.icons8.com/color/96/money-transfer.png" style="width: 50px;"
                                alt="Slip">
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="mb-1 fw-bold text-dark">{{ $slip['month'] }}</h6>
                                <i class='bx bx-chevron-right text-muted'></i>
                            </div>
                            <p class="mb-1 text-muted small">-</p>
                            <p class="mb-0 fw-bold" style="color: #00bfa5;">Rp {{ $slip['amount'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- REIMBURSEMENT TAB -->
        <div class="tab-pane fade" id="reimbursement-content" role="tabpanel" aria-labelledby="reimbursement-tab">
            <button type="button"
                class="btn btn-danger w-100 mb-4 py-2 fw-bold text-uppercase d-flex align-items-center justify-content-center gap-2"
                style="background-color: #ff6b6b; border: none; border-radius: 10px;" data-bs-toggle="modal"
                data-bs-target="#tambahKegiatanModal">
                Tambah Kegiatan
            </button>

            @php
                $reimbursements = [
                    ['name' => 'DINAS BULANAN', 'date' => '10-03-2026', 'status' => 'DRAFT'],
                    ['name' => 'DINAS BULANAN', 'date' => '11-02-2026', 'status' => 'DRAFT'],
                    ['name' => 'Dinas Ke Eropa', 'date' => '-', 'status' => 'DRAFT'],
                    ['name' => 'P', 'date' => '10-02-2026', 'status' => 'DIKLAIM'],
                    ['name' => 'Dinas', 'date' => '06-02-2026', 'status' => 'DIKLAIM'],
                    ['name' => 'Njdjs', 'date' => '-', 'status' => 'DRAFT'],
                    ['name' => 'Vxbcvb', 'date' => '-', 'status' => 'DRAFT'],
                ];
            @endphp

            @foreach ($reimbursements as $item)
                <div class="card mb-3 border-0 shadow-sm" style="border-radius: 12px; background-color: #fff;"
                    onclick="showReimbursementDetail('{{ $item['name'] }}', '{{ $item['date'] }}', '{{ $item['status'] }}')">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="bg-light rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                            style="width: 45px; height: 45px;">
                            <i class='bx bx-paste fs-4 text-muted'></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="mb-1 fw-bold text-dark" style="font-size: 0.95rem;">{{ $item['name'] }}</h6>
                                <span class="badge {{ $item['status'] == 'DIKLAIM' ? 'bg-success' : 'bg-secondary' }}"
                                    style="font-size: 0.6rem; letter-spacing: 0.5px; opacity: 0.8;">{{ $item['status'] }}</span>
                            </div>
                            <p class="mb-0 text-muted" style="font-size: 0.75rem;">Tgl: {{ $item['date'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Detail Slip Gaji -->
    <div class="modal fade" id="slipDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary py-3" style="border-radius: 0;">
                    <button type="button" class="btn p-0 text-white me-3" data-bs-dismiss="modal">
                        <i class='bx bx-chevron-left fs-3'></i>
                    </button>
                    <h5 class="modal-title text-white fs-6">Detail Gaji</h5>
                </div>
                <div class="modal-body p-0 bg-light">
                    <div class="bg-white p-3 mb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <div>
                                <h6 class="fw-bold mb-0 text-uppercase">{{ Auth::user()->name }}</h6>
                                <p class="small text-muted mb-0">Staff</p>
                            </div>
                            <p class="small fw-bold mb-0" id="slipDateText">01-12-2025</p>
                        </div>
                    </div>

                    <div class="px-3">
                        <!-- PENDAPATAN -->
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
                            <div class="card-header border-0 py-2"
                                style="background-color: #e8f5e9; color: #2e7d32; font-size: 0.85rem; font-weight: bold; text-transform: uppercase;">
                                Pendapatan
                            </div>
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Gaji Pokok</span>
                                    <span class="small fw-bold">Rp 1</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Lembur</span>
                                    <span class="small fw-bold">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">TUNJANGAN JABATAN</span>
                                    <span class="small fw-bold">Rp 180.000</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Dinas</span>
                                    <span class="small fw-bold">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">uang makan</span>
                                    <span class="small fw-bold">Rp 250.000</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted small">Uang Transpot</span>
                                    <span class="small fw-bold">Rp 500.000</span>
                                </div>
                                <hr class="my-2 opacity-10">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold small">Total</span>
                                    <span class="fw-bold small" style="color: #2e7d32;">Rp 930.001</span>
                                </div>
                            </div>
                        </div>

                        <!-- POTONGAN -->
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
                            <div class="card-header border-0 py-2"
                                style="background-color: #fce4ec; color: #c2185b; font-size: 0.85rem; font-weight: bold; text-transform: uppercase;">
                                Potongan
                            </div>
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Pinjaman benerin motor Ans...</span>
                                    <span class="small fw-bold">Rp 60.000</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Keterlambatan</span>
                                    <span class="small fw-bold">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Pulang Dini</span>
                                    <span class="small fw-bold">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Tidak Masuk / Alpha</span>
                                    <span class="small fw-bold">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted small">BPJS KESEHATAN</span>
                                    <span class="small fw-bold">Rp 68.000</span>
                                </div>
                                <hr class="my-2 opacity-10">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold small">Total</span>
                                    <span class="fw-bold small text-danger">Rp 128.000</span>
                                </div>
                            </div>
                        </div>

                        <!-- GAJI BERSIH -->
                        <div class="card border-0 shadow py-3 mb-4"
                            style="background-color: #00897b; border-radius: 12px;">
                            <div class="card-body p-0 px-3 d-flex justify-content-between align-items-center">
                                <span class="text-white fw-bold text-uppercase" style="font-size: 0.9rem;">Gaji
                                    Bersih</span>
                                <span class="text-white fw-bold h5 mb-0" id="slipAmountText">Rp 802.001</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold small text-dark mb-1">Catatan:</p>
                            <p class="text-muted small">-</p>
                        </div>

                        <div class="d-grid gap-3 mb-5 px-1">
                            <button
                                class="btn btn-primary py-2 fw-bold text-uppercase d-flex align-items-center justify-content-center gap-2"
                                style="border-radius: 10px;">
                                <i class='bx bx-download'></i> Download Slip Gaji
                            </button>
                            <button class="btn btn-success py-2 fw-bold text-uppercase"
                                style="background-color: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; border-radius: 10px;">
                                Sudah Dikonfirmasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Reimbursement -->
    <div class="modal fade" id="reimbursementDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary py-3" style="border-radius: 0;">
                    <button type="button" class="btn p-0 text-white me-3" data-bs-dismiss="modal">
                        <i class='bx bx-chevron-left fs-3'></i>
                    </button>
                    <h5 class="modal-title text-white fs-6">List Reimbursement</h5>
                </div>
                <div class="modal-body p-3 bg-white">
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="rounded-3 overflow-hidden me-3" style="width: 80px; height: 80px;">
                            <img src="https://via.placeholder.com/80" id="reimbursementImage"
                                class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bold mb-1" id="reimbursementNameText">P</h6>
                                <span class="small fw-bold" id="reimbursementAmountText">Rp 1.000.000</span>
                            </div>
                            <p class="text-muted small mb-0" id="reimbursementDateText">2026-02-10</p>
                        </div>
                    </div>

                    <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-white border-top">
                        <button class="btn border w-100 py-2 fw-bold text-uppercase" id="reimbursementStatusBtn"
                            style="border-radius: 8px; color: #333;">
                            SUDAH DIKLAIM
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kegiatan -->
    <div class="modal fade" id="tambahKegiatanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary py-3" style="border-radius: 0;">
                    <button type="button" class="btn p-0 text-white me-3" data-bs-dismiss="modal">
                        <i class='bx bx-chevron-left fs-3'></i>
                    </button>
                    <h5 class="modal-title text-white fs-6">Tambah Kegiatan</h5>
                </div>
                <div class="modal-body p-4">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-dark">Nama Kegiatan</label>
                            <input type="text" class="form-control" name="nama_kegiatan"
                                placeholder="Contoh: Perjalanan Dinas ke Bali" style="border-radius: 8px; padding: 12px;">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-dark">Tanggal Kegiatan</label>
                            <input type="date" class="form-control" name="tanggal_kegiatan"
                                value="{{ date('Y-m-d') }}" style="border-radius: 8px; padding: 12px;">
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-bold small text-dark">Mata Uang</label>
                            <select class="form-select" name="mata_uang" style="border-radius: 8px; padding: 12px;">
                                <option value="IDR">IDR</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 py-3 fw-bold text-uppercase shadow"
                            style="border: none; border-radius: 12px; font-size: 1rem;">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Tab Styling */
        .nav-tabs .nav-link {
            border: none;
            color: #566a7f;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }

        .nav-tabs .nav-link.active {
            /* Orange underline like in mockup */
            background: transparent;
        }

        /* Card Hover Effect */
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .card:active {
            transform: scale(0.98);
            box-shadow: none;
        }

        /* Badge styling */
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 600;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function showSlipDetail(month, date, amount) {
            document.getElementById('slipDateText').innerText = date;
            document.getElementById('slipAmountText').innerText = 'Rp ' + amount;
            var myModal = new bootstrap.Modal(document.getElementById('slipDetailModal'));
            myModal.show();
        }

        function showReimbursementDetail(name, date, status) {
            document.getElementById('reimbursementNameText').innerText = name;
            document.getElementById('reimbursementDateText').innerText = date;
            document.getElementById('reimbursementStatusBtn').innerText = status == 'DIKLAIM' ? 'SUDAH DIKLAIM' : 'DRAFT';

            // Dummy amount for demonstration
            document.getElementById('reimbursementAmountText').innerText = name == 'P' ? 'Rp 1.000.000' : 'Rp 0';

            var myModal = new bootstrap.Modal(document.getElementById('reimbursementDetailModal'));
            myModal.show();
        }
    </script>
@endpush
