@extends('layouts.app')

@section('title', 'Manajemen Jabatan & Akses Modul')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        {{-- KIRI : ICON + JUDUL --}}
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class='bx bx-user-check fs-4'></i>
            </div>
            <div>
                <h5 class="mb-0">Jabatan & Akses</h5>
                <small class="text-muted">Manajemen Jabatan dan Akses Modul</small>
            </div>
        </div>

        {{-- KANAN : BREADCRUMB --}}
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Manajemen Jabatan dan Akses Modul
                </li>
            </ol>
        </nav>

    </div>

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <h6 class="mb-0 fw-semibold">Daftar Jabatan</h6>
                <button class="btn btn-primary">
                    <i class="bx bx-plus"></i> Tambah
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 20%">Nama Jabatan</th>
                            <th>Akses Modul</th>
                            <th style="width: 5%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- ROW --}}
                        <tr>
                            <td>
                                <input type="text" class="form-control form-control-sm" value="Administrator">
                            </td>

                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge bg-secondary">Aplikasi Mobile</span>
                                    <span class="badge bg-secondary">Manajemen Pegawai</span>
                                    <span class="badge bg-secondary">Manajemen Ijin / Cuti</span>
                                    <span class="badge bg-secondary">Manajemen Slip Gaji</span>
                                    <span class="badge bg-secondary">Manajemen Absensi</span>
                                    <span class="badge bg-secondary">Manajemen Laporan</span>
                                    <span class="badge bg-secondary">Manajemen Setting</span>
                                    <span class="badge bg-secondary">Manajemen Billing</span>
                                    <span class="badge bg-secondary">Plugin BPJS</span>
                                </div>
                            </td>

                            <td class="text-center">
                                <button class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="form-control form-control-sm" value="Manager">
                            </td>

                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge bg-secondary">Aplikasi Mobile</span>
                                    <span class="badge bg-secondary">Plugin Template Kartu</span>
                                </div>
                            </td>

                            <td class="text-center">
                                <button class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="form-control form-control-sm" value="Staff">
                            </td>

                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge bg-secondary">Aplikasi Mobile</span>
                                    <span class="badge bg-secondary">Manajemen Absensi</span>
                                </div>
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

            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">
                    * Modul merupakan hak akses halaman admin
                </small>

                <button class="btn btn-success">
                    <i class="bx bx-save"></i> Update
                </button>
            </div>

        </div>
    </div>

@endsection
