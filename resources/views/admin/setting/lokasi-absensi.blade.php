@extends('layouts.app')

@section('title', 'Manajemen Lokasi Kantor / Cabang')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-map-pin fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Lokasi Absensi</h5>
                <small class="text-muted">Manajemen Lokasi Kantor / Cabang</small>
            </div>
        </div>

        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Manajemen Lokasi Kantor / Cabang
                </li>
            </ol>
        </nav>
    </div>

    {{-- TABEL --}}
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center g-3">
                <div class="col-md-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="switchRadius">
                        <label class="form-check-label" for="switchRadius">
                            Wajib Dalam Jangkauan
                        </label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="switchSelfie">
                        <label class="form-check-label" for="switchSelfie">
                            Wajib Foto Selfie
                        </label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="switchStandby">
                        <label class="form-check-label" for="switchStandby">
                            Wajib Standby Kantor
                        </label>
                    </div>
                </div>

                <div class="col-md-3 text-md-end">
                    <button class="btn btn-success px-3">
                        <i class="bx bx-plus me-1"></i> Tambah Lokasi
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>Nama Lokasi</th>
                        <th>Alamat Lengkap</th>
                        <th>Radius</th>
                        <th>Zona Waktu</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Indonesia</td>
                        <td>Indonesia</td>
                        <td class="text-center">30 M</td>
                        <td class="text-center">WIB</td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-sm me-1">
                                <i class="bx bx-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
