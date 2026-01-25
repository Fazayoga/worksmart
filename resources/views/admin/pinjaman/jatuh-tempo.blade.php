@extends('layouts.app')

@section('title', 'Jatuh Tempo')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-calendar-exclamation fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">
                    Management Pinjaman Jatuh Tempo Karyawan / Kasbon
                </h5>
                <small class="text-muted">Kelola pinjaman dan kasbon pegawai</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Management Pinjaman Jatuh Tempo Karyawan / Kasbon
                </li>
            </ol>
        </nav>

    </div>

    {{-- SUMMARY CARD --}}
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-lg">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px">
                        <i class="bx bx-wallet fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted">Total Pinjaman</small>
                        <h4 class="mb-0 fw-semibold">Rp. 10.000.000</h4>
                        {{-- {{ $totalPinjaman }} --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px">
                        <i class="bx bx-time-five fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted">Belum Lunas</small>
                        <h4 class="mb-0 fw-semibold">Rp. 6.000.000</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px">
                        <i class="bx bx-check-circle fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted">Sudah Lunas</small>
                        <h4 class="mb-0 fw-semibold">Rp. 4.000.000</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABLE CARD --}}
    <div class="card">
        <div class="card-header border-bottom">
            <div class="row g-2 align-items-center justify-content-end">
                <div class="col-12 col-lg-8">
                    <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2">

                        <!-- Select Filter -->
                        <select class="form-select flex-md-grow-0 w-100 w-md-auto">
                            <option selected disabled>Filter Berdasarkan</option>
                            <option value="nama">Nama</option>
                            <option value="jumlah">Jumlah Pinjaman</option>
                        </select>

                        <!-- Input Cari -->
                        <div class="input-group flex-md-grow-1 w-100">
                            <span class="input-group-text">
                                <i class="bx bx-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Cari data...">
                        </div>

                        <!-- Button Cari -->
                        <button class="btn btn-secondary w-100 w-md-auto px-4">
                            <i class="bx bx-filter-alt me-1"></i>
                            Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="table-responsive text-nowrap">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Tanggal Jatuh Tempo</th>
                        <th>Status</th>
                        <th>Sisa Pinjaman</th>
                        <th class="text-center">Detail</th>
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
                        <td>Rp 5.000.000</td>
                        <td>10 Jan 2025</td>
                        <td>
                            <span class="badge bg-label-warning">Belum Lunas</span>
                        </td>
                        <td>Rp 2.000.000</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info">
                                <i class="bx bx-show"></i>
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
                        <td>Rp 3.000.000</td>
                        <td>05 Jan 2025</td>
                        <td>
                            <span class="badge bg-label-success">Lunas</span>
                        </td>
                        <td>Rp 0</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info">
                                <i class="bx bx-show"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
