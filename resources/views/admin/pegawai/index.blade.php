@extends('layouts.app')

@section('title', 'Pegawai')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pegawai.css') }}">
@endpush
@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-group fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Pegawai</h5>
                <small class="text-muted">Kelola data pegawai dan karyawan</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Pegawai
                </li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-header border-bottom">
            <div class="row g-3">

                <!-- PEGAWAI AKTIF -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="pegawai-filter d-flex align-items-center gap-3 p-3 rounded bg-light cursor-pointer"
                        data-status="aktif">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px">
                            <i class="bx bx-user-check fs-5"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Pegawai Aktif</h6>
                            {{-- <h5 class="mb-0 fw-semibold">{{ $pegawaiAktif ?? 0 }}</h5> --}}
                            <h5 class="mb-0 fw-semibold">25</h5>
                        </div>
                    </div>
                </div>

                <!-- PEGAWAI TIDAK AKTIF -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="pegawai-filter d-flex align-items-center gap-3 p-3 rounded bg-light cursor-pointer"
                        data-status="nonaktif">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px">
                            <i class="bx bx-user-x fs-5"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Pegawai Tidak Aktif</h6>
                            {{-- <h5 class="mb-0 fw-semibold">{{ $pegawaiNonaktif ?? 0 }}</h5> --}}
                            <h5 class="mb-0 fw-semibold">5</h5>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="card-header border-bottom">
            <div class="row g-2 align-items-center">

                <!-- KIRI : ACTION -->
                <div class="col-12 col-lg-6">
                    <div class="d-flex flex-column flex-sm-row gap-2">

                        <a href="#" class="btn btn-primary">
                            <i class="bx bx-user-plus me-1"></i>
                            <span class="d-none d-sm-inline">Tambah Pegawai</span>
                            <span class="d-inline d-sm-none">Tambah</span>
                        </a>
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#importPegawaiModal">
                            <i class="bx bx-upload me-1"></i>
                            <span class="d-none d-sm-inline">Import Data</span>
                            <span class="d-inline d-sm-none">Import</span>
                        </button>

                        <button class="btn btn-outline-secondary">
                            <i class="bx bx-download me-1"></i>
                            <span class="d-none d-sm-inline">Edit Via Excel</span>
                            <span class="d-inline d-sm-none">Edit</span>
                        </button>

                    </div>
                </div>

                <!-- KANAN : FILTER -->
                <div class="col-12 col-lg-6">
                    <div class="d-flex flex-column flex-md-row gap-2 justify-content-lg-end">

                        <select class="form-select w-100 w-md-auto">
                            <option selected disabled>Filter Berdasarkan</option>
                            <option value="nama">Nama</option>
                            <option value="divisi">Divisi</option>
                            <option value="jabatan">Jabatan</option>
                        </select>

                        <div class="input-group w-100 w-md-auto">
                            <span class="input-group-text">
                                <i class="bx bx-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Cari Pegawai">
                        </div>
                        <!-- SORT ICON -->
                        <button type="button"
                            class="btn btn-outline-secondary d-flex align-items-center justify-content-center"
                            id="sortTanggal" data-sort="desc" title="Pendaftar Terbaru">
                            <i class="bx bx-sort-down fs-5"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- TABLE -->
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Tanggal Bergabung</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    {{-- @foreach ($pegawai as $row) --}}
                    {{-- <tr data-status="{{ $row->status }}"> --}}
                    <tr data-status="aktif">
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="../assets/img/avatars/1.png" class="rounded-circle" width="32">
                                <span>Ahmad Fauzi</span>
                                {{-- <span>{{ $row->nama }}</span> --}}
                            </div>
                        </td>
                        <td>ahmad@example.com {{-- {{ $row->email }} --}}</td>
                        <td>Staff IT {{-- {{ $row->jabatan }} --}}</td>
                        <td>
                            <span class="badge bg-label-success">Aktif</span>
                            {{-- 
                            <span class="badge bg-label-{{ $row->status == 'aktif' ? 'success' : 'secondary' }}">
                                {{ ucfirst($row->status) }}
                            </span>
                            --}}
                        </td>
                        <td>12 Jan 2025 {{-- {{ $row->created_at->format('d M Y') }} --}}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-warning">
                                <i class="bx bx-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                    {{-- @endforeach --}}

                    {{-- @foreach ($pegawai as $row) --}}
                    <tr data-status="nonaktif">
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="../assets/img/avatars/1.png" class="rounded-circle" width="32">
                                <span>Ahmad Fauzi</span>
                                {{-- <span>{{ $row->nama }}</span> --}}
                            </div>
                        </td>
                        <td>ahmad@example.com {{-- {{ $row->email }} --}}</td>
                        <td>Staff IT {{-- {{ $row->jabatan }} --}}</td>
                        <td>
                            <span class="badge bg-label-secondary">Nonaktif</span>
                            {{-- 
                            <span class="badge bg-label-{{ $row->status == 'aktif' ? 'success' : 'secondary' }}">
                                {{ ucfirst($row->status) }}
                            </span>
                            --}}
                        </td>
                        <td>12 Jan 2025 {{-- {{ $row->created_at->format('d M Y') }} --}}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-warning">
                                <i class="bx bx-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                    {{-- @endforeach --}}

                </tbody>

            </table>
        </div>
    </div>
@endsection
