@extends('layouts.app')

@section('title', 'Laporan Absensi')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        {{-- KIRI : ICON + JUDUL --}}
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-calendar-check fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Laporan Absensi</h5>
                <small class="text-muted">Rekap kehadiran karyawan</small>
            </div>
        </div>

        {{-- KANAN : BREADCRUMB --}}
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Laporan Absensi
                </li>
            </ol>
        </nav>

    </div>


    {{-- FILTER PERIODE --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h6 class="fw-semibold mb-3">Periode Laporan</h6>

            <div class="row g-3 align-items-end">

                <div class="col-12 col-md-3">
                    <select class="form-select">
                        <option selected disabled>Pilih Lokasi Absensi</option>
                        <option>Kantor Pusat</option>
                        <option>Cabang</option>
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <select class="form-select">
                        <option selected>Semua Divisi / Departemen</option>
                        <option>IT</option>
                        <option>HRD</option>
                        <option>Keuangan</option>
                    </select>
                </div>

                <div class="col-12 col-md-2">
                    <input type="date" class="form-control" placeholder="Tanggal Awal">
                </div>

                <div class="col-12 col-md-2">
                    <input type="date" class="form-control" placeholder="Tanggal Akhir">
                </div>

                <div class="col-12 col-md-2 d-grid">
                    <button class="btn btn-primary">
                        Proses
                    </button>
                </div>

            </div>

        </div>
    </div>


    {{-- TABEL ABSENSI --}}
    <div class="card shadow-sm">

        <div class="card-header border-bottom">
            <h6 class="mb-0 fw-semibold">Tabel Absen</h6>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr class="text-center">
                        <th>Nama Staff</th>
                        <th>Masuk Kerja</th>
                        <th>Jam Kerja</th>
                        <th>Jam Istirahat</th>
                        <th>Lembur</th>
                        <th>Jam Lembur</th>
                        <th>Kunjungan</th>
                        <th>Jam Kunjungan</th>
                        <th>Terlambat</th>
                        <th>Jam Terlambat</th>
                        <th>Cuti</th>
                        <th>Izin</th>
                        <th>Libur</th>
                        <th>Tidak Masuk</th>
                        <th>Detail</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">

                    {{-- KONDISI BELUM FILTER --}}
                    {{-- <tr>
                        <td colspan="15" class="text-center text-muted py-4">
                            Silakan pilih periode laporan terlebih dahulu
                        </td>
                    </tr> --}}

                    {{-- CONTOH DATA --}}

                    <tr class="text-center">
                        <td class="text-start fw-semibold">
                            Andi Pratama
                        </td>
                        <td>22</td>
                        <td>176</td>
                        <td>22</td>
                        <td>4</td>
                        <td>8</td>
                        <td>2</td>
                        <td>6</td>
                        <td>
                            <span class="badge bg-label-warning">3</span>
                        </td>
                        <td>01:15</td>
                        <td>1</td>
                        <td>0</td>
                        <td>2</td>
                        <td>
                            <span class="badge bg-label-danger">1</span>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-icon btn-outline-primary">
                                <i class="bx bx-detail"></i>
                            </a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

@endsection
