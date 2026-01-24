@extends('layouts.app')

@section('title', 'Broadcast')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-broadcast fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Broadcast</h5>
                <small class="text-muted">Kelola broadcast</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Broadcast
                </li>
            </ol>
        </nav>

    </div>
    <div class="card">
        <div class="card-header border-bottom">
            <div class="mb-2">
                <a href="" class="btn btn-success">
                    <i class="bx bx-plus me-1"></i>
                    Kirim Broadcast
                </a>
            </div>
        </div>

        <!-- TABLE -->
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Judul</th>
                        <th>Penerima</th>
                        <th>Prioritas</th>
                        <th>Tanggal Dikirim</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    <tr>
                        <td>Cuti Tahunan</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="../assets/img/avatars/2.png" class="rounded-circle" width="32">
                                <span>Ahmad Fauzi</span>
                            </div>
                        </td>
                        <td>10 Jan 2025</td>
                        <td>12 Jan 2025</td>
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
                        <td>Izin Sakit</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="../assets/img/avatars/3.png" class="rounded-circle" width="32">
                                <span>Siti Rahma</span>
                            </div>
                        </td>
                        <td>05 Jan 2025</td>
                        <td>05 Jan 2025</td>
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
