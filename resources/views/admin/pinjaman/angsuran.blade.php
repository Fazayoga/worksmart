@extends('layouts.app')

@section('title', 'Angsuran')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-wallet fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">
                    Management Ansuran Pinjaman Karyawan / Kasbon
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
                    Management Ansuran Pinjaman Karyawan / Kasbon
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
                        <h4 class="mb-0 fw-semibold">Rp. 600.000</h4>
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
                        <h4 class="mb-0 fw-semibold">Rp. 300.000</h4>
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
                        <h4 class="mb-0 fw-semibold">Rp. 300.000</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABLE CARD --}}
    <div class="card">
        <div class="card-header border-bottom">
            <div class="row g-2 align-items-center">

                <!-- KIRI : ACTION -->
                <div class="col-12 col-lg-4">
                    <a href="#" class="btn btn-primary w-100 w-lg-auto">
                        <i class="bx bx-plus me-1"></i>
                        Angsuran
                    </a>
                </div>

                <!-- KANAN : FILTER + SEARCH -->
                <div class="col-12 col-lg-8">
                    <div class="d-flex flex-column flex-md-row gap-2 justify-content-lg-end">

                        <!-- Select Filter -->
                        <select class="form-select w-100 w-md-auto">
                            <option selected disabled>Filter Berdasarkan</option>
                            <option value="nama">Nama</option>
                            <option value="alasan-pinjaman">Alasan Pinjaman</option>
                            <option value="tanggal-bayar">Tanggal Bayar</option>
                            <option value="jumlah">Jumlah</option>
                            <option value="ansuran">Angsuran</option>
                            <option value="metode">Metode</option>
                            <option value="status">Status</option>
                            <option value="keterangan">Keterangan</option>
                        </select>

                        <!-- Input Cari -->
                        <div class="input-group w-100 w-md-auto">
                            <span class="input-group-text">
                                <i class="bx bx-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Cari data...">
                        </div>

                        <!-- Button Cari -->
                        <button class="btn btn-secondary w-100 w-md-auto">
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
                    <tr class="text-center">
                        <th>Nama</th>
                        <th>Alasan Pinjaman</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Ansuran</th>
                        <th>Sisa Pinjaman</th>
                        <th>Metode</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
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
                        <td class="text-center">Benerin Motor</td>
                        <td class="text-center">10 Jan 2025</td>
                        <td class="text-center">Rp 300.000</td>
                        <td class="text-center">3</td>
                        <td class="text-center">Rp 300.000</td>
                        <td class="text-center">Potong Gaji</td>
                        <td class="text-center">Pinjaman benerin motor Ansuran Ke 3</td>
                        <td class="text-center">
                            <span class="badge bg-label-success">Berhasil</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-danger">
                                <i class="bx bx-trash"></i>
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
                        <td class="text-center">Benerin Motor</td>
                        <td class="text-center">10 Jan 2025</td>
                        <td class="text-center">Rp 300.000</td>
                        <td class="text-center">3</td>
                        <td class="text-center">Rp 300.000</td>
                        <td class="text-center">Potong Gaji</td>
                        <td class="text-center">Pinjaman benerin motor Ansuran Ke 3</td>
                        <td class="text-center">
                            <span class="badge bg-label-success">Berhasil</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-danger">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

@endsection
