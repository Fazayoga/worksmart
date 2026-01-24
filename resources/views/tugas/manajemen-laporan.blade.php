@extends('layouts.app')

@section('title', 'Manajemen Laporan')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Logo + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-file fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Manajemen Laporan</h5>
                <small class="text-muted">Kelola laporan tim</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Manajemen Laporan
                </li>
            </ol>
        </nav>

    </div>


    <!-- CARD -->
    <div class="card">
        <div class="card-body">
            <!-- TOP ACTION -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                <a href="" class="btn btn-success">
                    <i class="bx bx-plus me-1"></i> Tambah Laporan
                </a>

                <form class="d-flex" method="GET">
                    <select name="filter" class="form-select me-2" style="min-width: 200px">
                        <option value="">-----Filter-----</option>
                        <option value="judul">Judul</option>
                        <option value="tanggal">Tanggal</option>
                    </select>
                    <button class="btn btn-primary">
                        <i class="bx bx-search"></i> Cari
                    </button>
                </form>

            </div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Judul Laporan</th>
                            <th>Owener</th>
                            <th>Supervisor</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($laporan ?? [] as $row)
                            <tr>
                                <td>{{ $row->judul }}</td>
                                <td>{{ $row->owner }}</td>
                                <td>{{ $row->supervisor }}</td>
                                <td>{{ $row->tanggal }}</td>
                                <td>
                                    <span class="badge bg-label-info">
                                        {{ $row->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="" class="btn btn-success btn-sm">
                                        Detail
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Tidak ada data laporan
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- LOAD MORE -->
            <div class="d-flex justify-content-center align-items-center gap-2 mt-3">
                <input type="text" class="form-control form-control-sm text-center" style="width: 120px"
                    placeholder="Page">
                <button class="btn btn-info btn-sm">
                    Load More
                </button>
            </div>

        </div>
    </div>

@endsection
