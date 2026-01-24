@extends('layouts.app')

@section('title', 'Reimbursement')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Logo + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-receipt fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Reimbursement</h5>
                <small class="text-muted">Kelola reimbursement</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Reimbursement
                </li>
            </ol>
        </nav>

    </div>

    <div class="card">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 25%">Nama</th>
                            <th>Nama Kegiatan</th>
                            <th style="width: 15%">Tanggal</th>
                            <th style="width: 15%">Total</th>
                            <th style="width: 20%">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="../assets/img/avatars/2.png" class="rounded-circle" width="32">
                                    <span class="fw-semibold">Jhon Sena</span>
                                </div>
                            </td>
                            <td class="text-center">Maintenance Web</td>
                            <td class="text-center">2025-10-01</td>
                            <td class="text-center fw-semibold">Rp 50.000</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn btn-sm btn-success">Setujui</button>
                                    <button class="btn btn-sm btn-danger">Tolak</button>
                                    <button class="btn btn-sm btn-warning">Detail</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="../assets/img/avatars/2.png" class="rounded-circle" width="32">
                                    <span class="fw-semibold">Jhon Sena</span>
                                </div>
                            </td>
                            <td class="text-center">Maintenance Web</td>
                            <td class="text-center">2025-10-01</td>
                            <td class="text-center fw-semibold">Rp 50.000</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn btn-sm btn-success">Setujui</button>
                                    <button class="btn btn-sm btn-danger">Tolak</button>
                                    <button class="btn btn-sm btn-warning">Detail</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
