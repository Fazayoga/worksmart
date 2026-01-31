@extends('layouts.app')

@section('title', 'Trekking Lokasi Pegawai')

@section('content')
    <div class="row align-items-start align-items-md-center mb-4 g-3">

        <!-- KIRI : ICON + TITLE -->
        <div class="col-12 col-lg-8">
            <div class="d-flex align-items-start gap-3">

                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center flex-shrink-0"
                    style="width:48px;height:48px">
                    <i class="bx bx-current-location fs-4"></i>
                </div>

                <div>
                    <h5 class="mb-1 lh-sm">
                        Trekking Lokasi Pegawai Saat Perjalanan / Dinas / Wajib Standby Kantor
                        <span class="badge bg-label-warning align-middle ms-1">Beta</span>
                    </h5>
                    <small class="text-muted d-block">
                        Kelola lokasi pegawai saat perjalanan dinas
                    </small>
                </div>

            </div>
        </div>

        <!-- KANAN : BREADCRUMB -->
        <div class="col-12 col-lg-4 text-lg-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 justify-content-lg-end" style="--bs-breadcrumb-divider: '>';">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Trekking Lokasi Pegawai
                    </li>
                </ol>
            </nav>
        </div>

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
