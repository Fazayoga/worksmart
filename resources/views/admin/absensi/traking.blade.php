@extends('layouts.app')

@section('title', 'Trekking Lokasi Pegawai')

@section('content')

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold mb-1">
            <i class="bx bx-current-location me-1"></i>
            Trekking Lokasi Pegawai Saat Perjalanan / Dinas / Wajib Standby Kantor
            <span class="badge bg-label-warning ms-1">Beta</span>
        </h4>
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
            <ol class="breadcrumb breadcrumb-style1 mb-0">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Trekking Lokasi Pegawai
                </li>
            </ol>
        </nav>
    </div>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Logo + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-current-location fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">
                    Trekking Lokasi Pegawai Saat Perjalanan / Dinas / Wajib Standby Kantor
                    <span class="badge bg-label-warning ms-1">Beta</span>
                </h5>
                <small class="text-muted">Kelola lokasi pegawai saat perjalanan dinas</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Manajemen Tugas
                </li>
            </ol>
        </nav>

    </div>

    <!-- ================= PERJALANAN DINAS ================= -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">Perjalanan Dinas</h5>

            <form class="d-flex" method="GET">
                <input type="text" name="search_dinas" class="form-control form-control-sm me-2"
                    placeholder="Cari nama / tanggal...">
                <button class="btn btn-sm btn-primary">
                    <i class="bx bx-search"></i> Cari
                </button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Deskripsi Dinas</th>
                        <th class="text-center">Lihat Peta</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($perjalananDinas ?? [] as $row)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $row->avatar ?? asset('assets/img/avatars/default.png') }}"
                                        class="rounded-circle" width="36" height="36">
                                    <span class="fw-semibold">{{ $row->nama }}</span>
                                </div>
                            </td>
                            <td>{{ $row->tanggal_mulai }}</td>
                            <td>{{ $row->tanggal_selesai }}</td>
                            <td class="text-muted">
                                {{ $row->deskripsi }}
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-success">
                                    <i class="bx bx-map"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Tidak ada data perjalanan dinas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= ABSEN STANDBY ================= -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">Absen (Wajib Standby Kantor)</h5>

            <form class="d-flex" method="GET">
                <input type="text" name="search_absen" class="form-control form-control-sm me-2"
                    placeholder="Cari nama / tanggal...">
                <button class="btn btn-sm btn-primary">
                    <i class="bx bx-search"></i> Cari
                </button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Absen</th>
                        <th>Status</th>
                        <th>Deskripsi Absen</th>
                        <th class="text-center">Lihat Peta</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($absenStandby))
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Tidak ada data (Silakan Aktifkan Wajib Standby Kantor)
                            </td>
                        </tr>
                    @else
                        @foreach ($absenStandby as $row)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ $row->avatar ?? asset('assets/img/avatars/default.png') }}"
                                            class="rounded-circle" width="36">
                                        <span>{{ $row->nama }}</span>
                                    </div>
                                </td>
                                <td>{{ $row->tanggal }}</td>
                                <td>
                                    <span class="badge bg-label-success">
                                        {{ $row->status }}
                                    </span>
                                </td>
                                <td>{{ $row->deskripsi }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-success">
                                        <i class="bx bx-map"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
