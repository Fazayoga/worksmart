@extends('layouts.app')

@section('title', 'Manajemen Status Jam / Shift Kerja')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class='bx bx-time-five fs-4'></i>
            </div>
            <div>
                <h5 class="mb-0">Status Jam Kerja</h5>
                <small class="text-muted">Manajemen Status Jam/Shift Kerja</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Manajemen Status Jam/Shift Kerja
                </li>
            </ol>
        </nav>

    </div>

    {{-- TABS --}}
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="#">
                <i class="bx bx-time"></i> Jadwal Kerja
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bx bx-calendar-event"></i> Kegiatan
            </a>
        </li>
    </ul>

    {{-- TOGGLE KALENDER NASIONAL --}}
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center gap-3">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked />
                    <label class="form-check-label" for="flexSwitchCheckDefault">Kalender Nasional</label>
                </div>

                <div class="ms-auto">
                    <a href="#" class="btn btn-success">
                        <i class="bx bx-plus"></i> Status Jam Kerja
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 18%">Nama Jadwal / Shift</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Dispensasi</th>
                        <th style="width: 28%">Hari Kerja</th>
                        <th>Hari Libur</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td class="fw-semibold">Shift Pagi</td>
                        <td class="text-center">08:00</td>
                        <td class="text-center">16:00</td>
                        <td class="text-center">6 Menit</td>
                        <td>7 Hari (Senin, Selasa, Rabu, Kamis, Jumat, Sabtu)</td>
                        <td class="text-center">Tidak Menentu</td>
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
