@extends('layouts.app')

@section('title', 'Manajemen Perijinan & Cuti')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-calendar-check fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Management Pinjaman Karyawan / Kasbon</h5>
                <small class="text-muted">Kelola pengajuan izin dan cuti pegawai</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Management Pinjaman Karyawan / Kasbon
                </li>
            </ol>
        </nav>

    </div>

    {{-- <div class="card mb-4"> --}}
    <div class="card-body mb-4">
        <div class="row g-3 mb-4">

            <!-- 1. Pengajuan -->
            <div class="col-12 col-sm-6 col-lg">
                <div class="card h-100 shadow-sm card-hover">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                            style="width:48px;height:48px">
                            <i class="bx bx-file fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Pengajuan</small>
                            <h4 class="mb-0 fw-semibold">35</h4>
                            {{-- {{ $pengajuan }} --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Disetujui -->
            <div class="col-12 col-sm-6 col-lg">
                <div class="card h-100 shadow-sm card-hover">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center"
                            style="width:48px;height:48px">
                            <i class="bx bx-check-circle fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Disetujui</small>
                            <h4 class="mb-0 fw-semibold">20</h4>
                            {{-- {{ $disetujui }} --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Ditolak -->
            <div class="col-12 col-sm-6 col-lg">
                <div class="card h-100 shadow-sm card-hover">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center"
                            style="width:48px;height:48px">
                            <i class="bx bx-x-circle fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Ditolak</small>
                            <h4 class="mb-0 fw-semibold">2</h4>
                            {{-- {{ $ditolak }} --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Total -->
            <div class="col-12 col-sm-6 col-lg">
                <div class="card h-100 shadow-sm card-hover">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center"
                            style="width:48px;height:48px">
                            <i class="bx bx-layer fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total</small>
                            <h4 class="mb-0 fw-semibold">61</h4>
                            {{-- {{ $total }} --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. Kuota Harian -->
            <div class="col-12 col-sm-6 col-lg">
                <div class="card h-100 shadow-sm card-hover">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center"
                            style="width:48px;height:48px">
                            <i class="bx bx-time-five fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Kuota Harian</small>
                            <h4 class="mb-0 fw-semibold">4</h4>
                            {{-- {{ $kuotaHarian }} --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    {{-- </div> --}}

    <div class="card">
        <div class="card-header border-bottom">
            <div class="row g-2 align-items-center">

                <!-- KIRI : ACTION -->
                <div class="col-12 col-lg-6">
                    <div class="d-flex flex-column flex-sm-row gap-2">

                        <a href="#" class="btn btn-primary w-sm-auto">
                            <i class="bx bx-calendar-plus me-1"></i>
                            <span class="d-none d-sm-inline">Izin / Cuti</span>
                            <span class="d-inline d-sm-none">Izin / Cuti</span>
                        </a>

                        <button class="btn btn-success w-sm-auto">
                            <i class="bx bx-calendar-event me-1"></i>
                            <span class="d-none d-sm-inline">Cuti Bersama</span>
                            <span class="d-inline d-sm-none">Cuti Bersama</span>
                        </button>
                        <button class="btn btn-dark w-sm-auto">
                            <i class="bx bx-pie-chart-alt-2 me-1"></i>
                            <span class="d-none d-sm-inline">Kuota Cuti / Izin</span>
                            <span class="d-inline d-sm-none">Kuota Cuti / Izin</span>
                        </button>

                    </div>
                </div>

                <!-- KANAN : FILTER -->
                <div class="col-12 col-lg-6">
                    <div class="d-flex flex-column flex-md-row gap-2 justify-content-lg-end">

                        <!-- Cari Nama -->
                        <div class="input-group w-100 w-md-auto">
                            <span class="input-group-text">
                                <i class="bx bx-user"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Cari Pegawai">
                        </div>

                        <!-- Filter Tanggal -->
                        <div class="input-group w-100 w-md-auto">
                            <span class="input-group-text">
                                <i class="bx bx-calendar"></i>
                            </span>
                            <input type="date" class="form-control">
                        </div>

                        <button class="btn btn-warning w-75 w-sm-auto">
                            <i class="bx bx-reset me-1"></i>
                            <span class="d-none d-sm-inline">Reset Jatah Cuti</span>
                            <span class="d-inline d-sm-none">Reset Jatah Cuti</span>
                        </button>

                    </div>
                </div>

            </div>
        </div>

        <!-- TABLE -->
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Nama Pegawai</th>
                        <th>Jenis</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="../assets/img/avatars/2.png" class="rounded-circle" width="32">
                                <span>Ahmad Fauzi</span>
                            </div>
                        </td>
                        <td>Cuti Tahunan</td>
                        <td>10 Jan 2025</td>
                        <td>12 Jan 2025</td>
                        <td>Liburan Keluarga</td>
                        <td>
                            <span class="badge bg-label-warning">Menunggu</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-success">
                                <i class="bx bx-check"></i>
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="bx bx-x"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="../assets/img/avatars/3.png" class="rounded-circle" width="32">
                                <span>Siti Rahma</span>
                            </div>
                        </td>
                        <td>Izin Sakit</td>
                        <td>05 Jan 2025</td>
                        <td>05 Jan 2025</td>
                        <td>Demam</td>
                        <td>
                            <span class="badge bg-label-success">Disetujui</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-secondary" disabled>
                                <i class="bx bx-lock"></i>
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
