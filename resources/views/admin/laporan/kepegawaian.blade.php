@extends('layouts.app')

@section('title', 'Laporan Pegawai')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        {{-- KIRI : Icon + Title --}}
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-user-circle fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Laporan Pegawai</h5>
                <small class="text-muted">Ringkasan data pegawai</small>
            </div>
        </div>

        {{-- KANAN : Breadcrumb --}}
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Laporan Pegawai
                </li>
            </ol>
        </nav>

    </div>

    {{-- STATISTIK AKTIF / NON AKTIF --}}
    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <small>Jumlah Pegawai Aktif</small>
                    <h3 class="mb-0">9</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <small>Jumlah Pegawai Tidak Aktif</small>
                    <h3 class="mb-0">2</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <small>Total Pegawai</small>
                    <h3 class="mb-0">11</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- STATISTIK STATUS --}}
    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <small>Pegawai Tetap</small>
                    <h3 class="mb-0">8</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <small>Pegawai Training</small>
                    <h3 class="mb-0">0</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <small>Pegawai Kontrak</small>
                    <h3 class="mb-0">1</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- STATISTIK MASA KERJA --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <small>Masa Kerja &lt; 1 Tahun</small>
                    <h3 class="mb-0">1</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <small>Masa Kerja 1 - 5 Tahun</small>
                    <h3 class="mb-0">8</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <small>Masa Kerja &gt; 5 Tahun</small>
                    <h3 class="mb-0">0</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="row g-3">

        {{-- JABATAN --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Jabatan
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Jabatan</th>
                                <th class="text-center">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Administrator</td>
                                <td class="text-center">2</td>
                            </tr>
                            <tr>
                                <td>Direktur</td>
                                <td class="text-center">1</td>
                            </tr>
                            <tr>
                                <td>Koordinator</td>
                                <td class="text-center">1</td>
                            </tr>
                            <tr>
                                <td>Supervisor</td>
                                <td class="text-center">1</td>
                            </tr>
                            <tr>
                                <td>Staff</td>
                                <td class="text-center">5</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- DIVISI --}}
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Divisi
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Divisi</th>
                                <th class="text-center">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Administrasi</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td>Keuangan</td>
                                <td class="text-center">0</td>
                            </tr>
                            <tr>
                                <td>Teknisi</td>
                                <td class="text-center">0</td>
                            </tr>
                            <tr>
                                <td>Security</td>
                                <td class="text-center">0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- KONTRAK < 3 BULAN --}}
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Masa Kontrak &lt; 3 Bulan
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Pegawai</th>
                                <th class="text-center">Habis Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" class="text-center text-muted">
                                    Data Kosong
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
