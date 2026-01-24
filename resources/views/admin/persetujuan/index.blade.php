@extends('layouts.app')

@section('title', 'Absen Disetujui')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Logo + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-check-circle fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Persetujuan</h5>
                <small class="text-muted">Kelola persetujuan</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Persetujuan
                </li>
            </ol>
        </nav>

    </div>

    <div class="row g-4">

        <!-- ATAS KIRI : ABSENSI MASUK -->
        <div class="col-md-6">
            <div class="card h-100">
                <h5 class="card-header">Absensi Masuk</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th width="40">
                                    <input type="checkbox" class="form-check-input" id="checkAllMasuk">
                                </th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <button class="btn btn-sm btn-success me-1">
                        <i class="bx bx-check"></i> Setujui
                    </button>
                    <button class="btn btn-sm btn-danger">
                        <i class="bx bx-x"></i> Tolak
                    </button>
                </div>
            </div>
        </div>

        <!-- ATAS KANAN : PENGAJUAN LIBUR -->
        <div class="col-md-6">
            <div class="card h-100">
                <h5 class="card-header">Absensi Pengajuan Libur</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th width="40">
                                    <input type="checkbox" class="form-check-input" id="checkAllMasuk">
                                </th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <button class="btn btn-sm btn-success me-1">
                        <i class="bx bx-check"></i> Setujui
                    </button>
                    <button class="btn btn-sm btn-danger">
                        <i class="bx bx-x"></i> Tolak
                    </button>
                </div>
            </div>
        </div>

        <!-- BAWAH KIRI : PENGAJUAN KUNJUNGAN -->
        <div class="col-md-6">
            <div class="card h-100">
                <h5 class="card-header">Absensi Pengajuan Kunjungan</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th width="40">
                                    <input type="checkbox" class="form-check-input" id="checkAllMasuk">
                                </th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <button class="btn btn-sm btn-success me-1">
                        <i class="bx bx-check"></i> Setujui
                    </button>
                    <button class="btn btn-sm btn-danger">
                        <i class="bx bx-x"></i> Tolak
                    </button>
                </div>
            </div>
        </div>

        <!-- BAWAH KANAN : RIWAYAT TIDAK DISETUJUI -->
        <div class="col-md-6">
            <div class="card h-100 border-danger">

                <!-- HEADER -->
                <h5 class="card-header text-danger d-flex align-items-center gap-2">
                    <i class="bx bx-x-circle"></i>
                    Riwayat Absensi Tidak Disetujui
                </h5>

                <!-- 1. KOLOM CARI -->
                <div class="px-4 pb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bx bx-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Cari nama / alasan penolakan..."
                            id="searchRejectedAbsensi">
                    </div>
                </div>

                <!-- TABLE -->
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Tgl Absensi</th>
                                <th>Tgl Ditolak</th>
                                <th>Jenis</th>
                                <th>Jam</th>
                                <th>Alasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Tidak ada data
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>

                <!-- 2. LOAD MORE -->
                <div class="card-footer bg-transparent text-center">
                    <button class="btn btn-outline-danger btn-sm">
                        <i class="bx bx-refresh"></i>
                        Load More
                    </button>
                </div>

            </div>
        </div>
    </div>

@endsection
