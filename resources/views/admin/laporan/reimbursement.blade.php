@extends('layouts.app')

@section('title', 'Laporan Reimbursement')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-receipt fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Laporan Reimbursement</h5>
                <small class="text-muted">Kelola Laporan Reimbursement</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Laporan Reimbursement
                </li>
            </ol>
        </nav>

    </div>

    {{-- SUMMARY CARD --}}
    <div class="row g-3 mb-4">

        {{-- KIRI : PILIH TAHUN --}}
        <div class="col-12 col-lg-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column gap-3">

                    <h6 class="fw-semibold mb-0">Pilih Tahun</h6>

                    <!-- Select Tahun -->
                    <select class="form-select" id="tahun">
                        <option value="2025" selected>2025</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                    </select>

                    <!-- Button Cetak -->
                    <button class="btn btn-outline-primary w-100" onclick="cetakLaporan()">
                        <i class="bx bx-printer me-1"></i>
                        Cetak Laporan Reimbursement
                    </button>

                </div>
            </div>
        </div>


        {{-- KANAN : TOTAL PENGGAJIAN --}}
        <div class="col-12 col-lg-9">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-semibold mb-4">
                        Total Reimbursement Periode 2025
                    </h6>
                    <div class="row g-3">
                        <!-- Total Reimbursement -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="border rounded-3 p-3 text-center shadow-sm h-100">
                                <div class="mb-2">
                                    <i class="bx bx-receipt text-primary fs-3"></i>
                                </div>
                                <small class="text-muted d-block">Total Reimbursement</small>
                                <h5 class="fw-bold mb-0">6</h5>
                            </div>
                        </div>
                        <!-- Disetujui -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="border rounded-3 p-3 text-center shadow-sm h-100">
                                <div class="mb-2">
                                    <i class="bx bx-check-circle text-success fs-3"></i>
                                </div>
                                <small class="text-muted d-block">Disetujui</small>
                                <h5 class="fw-bold mb-0">5</h5>
                            </div>
                        </div>
                        <!-- Ditolak -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="border rounded-3 p-3 text-center shadow-sm bg-light h-100">
                                <div class="mb-2">
                                    <i class="bx bx-x-circle text-danger fs-3"></i>
                                </div>
                                <small class="text-muted d-block">Ditolak</small>
                                <h5 class="fw-bold mb-0">7</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h6 class="fw-semibold mb-3">
                Grafik Reimbursement Periode Tahun 2025
            </h6>

            <div class="text-center text-muted py-5">
                <canvas id="reimbursementChart" height="100"></canvas>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header border-bottom">
            <h6 class="mb-0 fw-semibold">Tabel Reimbursement</h6>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Bulan</th>
                        <th>Ijin</th>
                        <th>Cuti</th>
                        <th>Disetujui</th>
                        <th>Ditolak</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>Januari</td>
                        <td>5</td>
                        <td>2</td>
                        <td>6</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>Februari</td>
                        <td>4</td>
                        <td>3</td>
                        <td>5</td>
                        <td>2</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/grafik.js') }}"></script>
@endpush
<script>
    function cetakLaporan() {
        const tahun = document.getElementById('tahun').value;
        window.open(`/reimbursement/cetak?tahun=${tahun}`, '_blank');
    }
</script>
