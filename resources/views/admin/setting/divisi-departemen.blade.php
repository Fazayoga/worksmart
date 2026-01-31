@extends('layouts.app')

@section('title', 'Divisi')

@section('content')
    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        {{-- KIRI : ICON + JUDUL --}}
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class='bx bx-buildings fs-4'></i>
            </div>
            <div>
                <h5 class="mb-0">Management Divisi</h5>
                <small class="text-muted">Manajemen Divisi</small>
            </div>
        </div>
        {{-- KANAN : BREADCRUMB --}}
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Management Divisi
                </li>
            </ol>
        </nav>
    </div>
    {{-- CARD --}}
    <div class="card">
        <div class="card-header border-bottom">
            <div class="row g-2 align-items-center">
                <div class="d-flex flex-column flex-md-row gap-2 left-content-lg-end">
                    <!-- Pilih Filter -->
                    <button class="btn btn-primary">
                        <i class="bx bx-plus"></i> Divisi
                    </button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 35%">Nama Jabatan</th>
                        <th style="width: 35%">Akses Modul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- ROW --}}
                    <tr>
                        <td>
                            Administrasi
                        </td>
                        <td>
                            Bidang Administrasi
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning">
                                <i class="bx bx-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Keuangan
                        </td>
                        <td>
                            Bidang Keuangan
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning">
                                <i class="bx bx-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Teknisi
                        </td>
                        <td>
                            Bidang Teknisi
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning">
                                <i class="bx bx-pencil"></i>
                            </button>
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
