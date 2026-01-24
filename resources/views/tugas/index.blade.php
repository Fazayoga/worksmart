@extends('layouts.app')

@section('title', 'Manajemen Tugas')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Logo + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-briefcase fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Manajemen Tugas</h5>
                <small class="text-muted">Kelola tugas dan progres tim</small>
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

    <div class="card">
        <div class="card-header border-bottom">
            <div class="row g-2 align-items-center">

                <!-- KIRI : ACTION -->
                <div class="col-12 col-lg-6">
                    <div class="d-flex flex-column flex-sm-row gap-2">

                        <a href="#" class="btn btn-primary w-sm-auto">
                            <i class="bx bx-plus me-1"></i>
                            <span class="d-none d-sm-inline">Tambah Tugas Baru</span>
                            <span class="d-inline d-sm-none">Tambah</span>
                        </a>

                        <button class="btn btn-outline-secondary w-sm-auto">
                            <i class="bx bx-download me-1"></i>
                            <span class="d-none d-sm-inline">Unduh Laporan</span>
                            <span class="d-inline d-sm-none">Unduh</span>
                        </button>

                    </div>
                </div>

                <!-- KANAN : FILTER -->
                <div class="col-12 col-lg-6">
                    <div class="d-flex flex-column flex-md-row gap-2 justify-content-lg-end">

                        <!-- Pilih Filter -->
                        <select class="form-select w-100 w-md-auto">
                            <option selected disabled>Filter Berdasarkan</option>
                            <option value="nama">Nama</option>
                            <option value="tanggal">Tanggal</option>
                        </select>

                        <!-- Filter Nama -->
                        <div class="input-group w-100 w-md-auto">
                            <span class="input-group-text">
                                <i class="bx bx-user"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Cari Nama">
                        </div>

                        <!-- Filter Tanggal -->
                        <div class="input-group w-100 w-md-auto">
                            <span class="input-group-text">
                                <i class="bx bx-calendar"></i>
                            </span>
                            <input type="date" class="form-control">
                            <input type="date" class="form-control">
                        </div>

                    </div>
                </div>

            </div>
        </div>


        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Nama Tugas</th>
                        <th>Tim</th>
                        <th>Dibuat</th>
                        <th>Owner</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                            <i class="icon-base bx bxl-angular icon-md text-danger me-4"></i> <span>Angular Project</span>
                        </td>
                        <td>1</td>
                        <td>Albert Cook</td>
                        <td>
                            <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                    <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                    <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Christina Parker">
                                    <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                                </li>
                            </ul>
                        </td>
                        <td><span class="badge bg-label-primary me-1">Active</span></td>
                        <td>1</td>
                        <td>
                            {{-- <form action="{{ route('tugas.destroy', $tugas->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form> --}}
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="icon-base bx bxl-react icon-md text-info me-4"></i> <span>React Project</span>
                        </td>
                        <td>1</td>
                        <td>Barry Hunter</td>
                        <td>
                            <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                    <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                    <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Christina Parker">
                                    <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                                </li>
                            </ul>
                        </td>
                        <td><span class="badge bg-label-success me-1">Completed</span></td>
                        <td>1</td>
                        <td>
                            {{-- <form action="{{ route('tugas.destroy', $tugas->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form> --}}
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
