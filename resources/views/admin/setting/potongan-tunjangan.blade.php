@extends('layouts.app')

@section('title', 'Potongan Tunjangan')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class='bx bx-money-withdraw fs-4'></i>
            </div>
            <div>
                <h5 class="mb-0">Potongan & Tunjangan</h5>
                <small class="text-muted">Kelola aturan potongan dan tunjangan pegawai</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Potongan & Tunjangan
                </li>
            </ol>
        </nav>

    </div>

    {{-- TAB --}}
    <ul class="nav nav-pills mb-3 gap-2">
        <li class="nav-item">
            <a class="nav-link active" href="#">Potongan Terlambat</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Pulang Cepat</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Alpha / Tidak Masuk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Fee Lembur</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Fee Dinas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Tunjangan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Potongan Lain</a>
        </li>
    </ul>

    <button class="btn btn-success mb-3">
        <i class='bx bx-plus'></i>
        <span>Tambah</span>
    </button>

    {{-- TABLE --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nominal</th>
                        <th>Tipe</th>
                        <th>Atribut</th>
                        <th>Jadwal</th>
                        <th>Aturan Potongan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="fw-semibold text-danger">
                            Rp 5.000
                        </td>
                        <td>Pegawai</td>
                        <td>Cekgu Besar</td>
                        <td>
                            <span class="badge bg-secondary">Shift Pagi</span>
                            <span class="badge bg-info">Full Time</span>
                        </td>
                        <td>
                            <small class="text-muted">
                                Setiap <b>1 menit</b> terlambat<br>
                                Potong = menit × nominal
                            </small>
                        </td>
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
