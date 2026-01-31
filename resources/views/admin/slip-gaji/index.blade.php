@extends('layouts.app')

@section('title', 'Slip Gaji')

@section('content')
    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        {{-- KIRI : ICON + JUDUL --}}
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class='bx bx-wallet-alt fs-4'></i>
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
                        <i class="bx bx-plus"></i> Periode
                    </button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 25%">Periode</th>
                        <th style="width: 15%">Total Staff</th>
                        <th style="width: 15%">Total Slip Gaji</th>
                        <th style="width: 25%">Total Gaji</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- ROW --}}
                    <tr>
                        <td>
                            January 2026
                        </td>
                        <td class="text-center">
                            1
                        </td>
                        <td class="text-center">
                            6
                        </td>
                        <td class="text-center">
                            Rp 30.000.000
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning">
                                <i class="bx bx-file"></i>
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            February 2026
                        </td>
                        <td class="text-center">
                            1
                        </td>
                        <td class="text-center">
                            6
                        </td>
                        <td class="text-center">
                            Rp 30.000.000
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning">
                                <i class="bx bx-file"></i>
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
