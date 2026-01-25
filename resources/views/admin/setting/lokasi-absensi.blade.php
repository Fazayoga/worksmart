@extends('layouts.app')

@section('title', 'Manajemen Lokasi Kantor / Cabang')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class='bx bx-map-pin fs-4'></i>
            </div>
            <div>
                <h5 class="mb-0">Lokasi Absensi</h5>
                <small class="text-muted">Manajemen Lokasi Kantor / Cabang</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Manajemen Lokasi Kantor / Cabang
                </li>
            </ol>
        </nav>

    </div>

    {{-- TOGGLE GLOBAL --}}
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="row align-items-center">
                <div class="col-md-3 d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" />
                        <label class="form-check-label" for="flexSwitchCheckDefault">Wajib Dalam Jangkauan</label>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" />
                        <label class="form-check-label" for="flexSwitchCheckDefault">Wajib Foto Selfie</label>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" />
                        <label class="form-check-label" for="flexSwitchCheckDefault">Wajib Standby Kantor</label>
                    </div>
                </div>

                <div class="col-md-3 text-end">
                    <a href="#" class="btn btn-success">
                        <i class="bx bx-plus"></i> Lokasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <div class="table-responsive text-nowrap">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Lokasi</th>
                            <th>Alamat Lengkap</th>
                            <th>Radius</th>
                            <th>Zona Waktu</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="table-border-bottom-0">

                        <tr>
                            <td>Indonesia</td>
                            <td>Indonesia</td>
                            <td>30 M</td>
                            <td>WIB</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-1">
                                    <i class='bx bx-edit'></i>
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
    </div>

@endsection
