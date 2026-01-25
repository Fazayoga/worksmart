@extends('layouts.app')

@section('title', 'Laporan Gaji')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-money fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Laporan Gaji</h5>
                <small class="text-muted">Kelola laporan gaji</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Laporan Gaji
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
                        Cetak Laporan Gaji
                    </button>

                </div>
            </div>
        </div>


        {{-- KANAN : TOTAL PENGGAJIAN --}}
        <div class="col-12 col-lg-9">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">
                        Total Penggajian Periode 2025
                    </h6>

                    <div class="row g-3">

                        <div class="col-6 col-lg-3">
                            <div class="border rounded p-3 text-center shadow-sm">
                                <i class="bx bx-wallet text-primary fs-4 mb-1"></i>
                                <small class="text-muted d-block">Gaji Pokok</small>
                                <strong>Rp 120.000.000</strong>
                            </div>
                        </div>

                        <div class="col-6 col-lg-3">
                            <div class="border rounded p-3 text-center shadow-sm">
                                <i class="bx bx-minus-circle text-danger fs-4 mb-1"></i>
                                <small class="text-muted d-block">Potongan</small>
                                <strong>Rp 20.000.000</strong>
                            </div>
                        </div>

                        <div class="col-6 col-lg-3">
                            <div class="border rounded p-3 text-center shadow-sm">
                                <i class="bx bx-gift text-success fs-4 mb-1"></i>
                                <small class="text-muted d-block">Tunjangan & Bonus</small>
                                <strong>Rp 30.000.000</strong>
                            </div>
                        </div>

                        <div class="col-6 col-lg-3">
                            <div class="border rounded p-3 text-center shadow-sm bg-light">
                                <i class="bx bx-calculator text-dark fs-4 mb-1"></i>
                                <small class="text-muted d-block">Total Gaji</small>
                                <strong>Rp 130.000.000</strong>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Buatkan "grafik penggajian periode tahun (yang dipilih)" --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h6 class="fw-semibold mb-3">
                Grafik Penggajian Periode Tahun 2025
            </h6>

            <div class="text-center text-muted py-5">
                {{-- nanti isi chart.js / apexchart --}}
                <canvas id="gajiChart" height="100"></canvas>
            </div>
        </div>
    </div>


    {{-- Ubah tabel ini, "Tabel Penggajian", dengan isi Bulan, Gaji Pokok, Potongan, Tunjangan & Bonus, Total Gaji --}}
    <div class="card">
        <div class="card-header border-bottom">
            <h6 class="mb-0 fw-semibold">Tabel Penggajian</h6>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Bulan</th>
                        <th>Gaji Pokok</th>
                        <th>Potongan</th>
                        <th>Tunjangan & Bonus</th>
                        <th>Total Gaji</th>
                    </tr>
                </thead>


                <tbody class="table-border-bottom-0">

                    <tr>
                        <td>Januari</td>
                        <td>Rp 5.000.000</td>
                        <td>Rp 500.000</td>
                        <td>Rp 2.000.000</td>
                        <td>Rp 2.000.000</td>
                    </tr>

                    <tr>
                        <td>Februari</td>
                        <td>Rp 3.000.000</td>
                        <td>Rp 300.000</td>
                        <td>Rp 2.000.000</td>
                        <td>Rp 2.000.000</td>
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

        // contoh redirect ke route cetak
        window.open(`/laporan-gaji/cetak?tahun=${tahun}`, '_blank');
    }
</script>
