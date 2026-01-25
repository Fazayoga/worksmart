@extends('layouts.app')

@section('title', 'Laporan Ijin / Cuti')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-calendar-check fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Laporan Ijin / Cuti</h5>
                <small class="text-muted">Kelola Laporan Ijin / Cuti</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Laporan Ijin / Cuti
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
                        Cetak Laporan Ijin / Cuti
                    </button>

                </div>
            </div>
        </div>


        {{-- KANAN : TOTAL PENGGAJIAN --}}
        <div class="col-12 col-lg-9">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">
                        Total Ijin / Cuti Periode 2025
                    </h6>

                    <div class="row g-3">

                        <div class="col-6 col-lg-3">
                            <div class="border rounded p-3 text-center shadow-sm">
                                <i class="bx bx-calendar text-primary fs-4 mb-1"></i>
                                <small class="text-muted d-block">Ijin</small>
                                <strong>6</strong>
                            </div>
                        </div>


                        <div class="col-6 col-lg-3">
                            <div class="border rounded p-3 text-center shadow-sm">
                                <i class="bx bx-briefcase text-danger fs-4 mb-1"></i>
                                <small class="text-muted d-block">Cuti</small>
                                <strong>3</strong>
                            </div>
                        </div>

                        <div class="col-6 col-lg-3">
                            <div class="border rounded p-3 text-center shadow-sm">
                                <i class="bx bx-check-circle text-success fs-4 mb-1"></i>
                                <small class="text-muted d-block">Disetujui</small>
                                <strong>5</strong>
                            </div>
                        </div>

                        <div class="col-6 col-lg-3">
                            <div class="border rounded p-3 text-center shadow-sm bg-light">
                                <i class="bx bx-x-circle text-dark fs-4 mb-1"></i>
                                <small class="text-muted d-block">Ditolak</small>
                                <strong>7</strong>
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
                Grafik Ijin & Cuti Periode Tahun 2025
            </h6>

            <div class="text-center text-muted py-5">
                <canvas id="ijin-cutiChart" height="100"></canvas>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header border-bottom">
            <h6 class="mb-0 fw-semibold">Tabel Ijin / Cuti</h6>
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
        window.open(`/laporan-ijin-cuti/cetak?tahun=${tahun}`, '_blank');
    }
</script>
