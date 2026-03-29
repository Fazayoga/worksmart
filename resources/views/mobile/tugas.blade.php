@extends('layouts.mobile')

@section('title', 'Tugas')

@section('content')
    <div class="mobile-header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/img/avatars/1.png') }}" alt="Avatar"
                class="rounded-circle border border-2 border-white" style="width: 35px; height: 35px; background: white;">
            <span class="h5 mb-0 text-white fw-bold">Tugas</span>
        </div>
        <div class="dropdown">
            <button class="btn p-0 text-white" type="button" data-bs-toggle="dropdown">
                <i class='bx bx-dots-vertical-rounded fs-4'></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.close();">Exit</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs nav-fill bg-white border-bottom" id="tugasTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold text-uppercase py-3" id="tugas-tab" data-bs-toggle="tab"
                data-bs-target="#tugas-content" type="button" role="tab" aria-controls="tugas-content"
                aria-selected="true" style="font-size: 0.85rem; letter-spacing: 0.5px;">Tugas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold text-uppercase py-3" id="laporan-tab" data-bs-toggle="tab"
                data-bs-target="#laporan-content" type="button" role="tab" aria-controls="laporan-content"
                aria-selected="false" style="font-size: 0.85rem; letter-spacing: 0.5px;">Laporan</button>
        </li>
    </ul>

    <div class="tab-content container-fluid py-3" id="tugasTabsContent">
        <!-- TUGAS TAB -->
        <div class="tab-pane fade show active" id="tugas-content" role="tabpanel" aria-labelledby="tugas-tab">
            <button type="button" class="btn btn-danger w-100 mb-3 py-2 fw-bold"
                style="border: none; text-transform: uppercase;" data-bs-toggle="modal" data-bs-target="#tambahTugasModal">
                Tambah Tugas
            </button>
            <div class="alert alert-warning border-0 shadow-sm text-center py-4"
                style="background-color: #fff9db; color: #856404; font-size: 0.9rem;">
                Anda Belum Ada Proyek.
            </div>
        </div>

        <!-- LAPORAN TAB -->
        <div class="tab-pane fade" id="laporan-content" role="tabpanel" aria-labelledby="laporan-tab">
            <button type="button" class="btn btn-danger w-100 mb-3 py-2 fw-bold" data-bs-toggle="modal"
                data-bs-target="#tambahLaporanModal">
                Tambah Laporan
            </button>
            <div class="alert alert-light border-0 shadow-sm text-start py-3 px-3 bg-white"
                style="color: #566a7f; font-size: 0.95rem;">
                Tidak Ada Laporan
            </div>
        </div>
    </div>

    <!-- Modal Tambah Tugas -->
    <div class="modal fade" id="tambahTugasModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0">
                <div class="modal-header py-3 bg-primary">
                    <h5 class="modal-title text-white fs-6">Tambah Tugas</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Judul</label>
                            <input type="text" class="form-control form-control-sm" name="judul" placeholder="Judul">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Tim / Personil</label>
                            <select class="form-select form-select-sm" name="personil">
                                <option value="">Pilih</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Deskripsi</label>
                            <textarea class="form-control form-control-sm" name="deskripsi" rows="3" placeholder="Deskripsi Tugas"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">
                            Tambahkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Laporan -->
    <div class="modal fade" id="tambahLaporanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary py-3">
                    <h5 class="modal-title text-white fs-6">Tambah Laporan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Judul Laporan</label>
                            <input type="text" class="form-control form-control-sm" name="judul_laporan"
                                placeholder="Judul Laporan">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Project (Tidak Wajib)</label>
                            <select class="form-select form-select-sm" name="project_id">
                                <option value="">Silahkan Pilih</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Dapat dilihat oleh</label>
                            <select class="form-select form-select-sm" name="visible_to">
                                <option value="">Pilih Anggota</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Deskripsi</label>
                            <textarea class="form-control form-control-sm" name="deskripsi" rows="3"
                                placeholder="Deskripsi Laporan"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Gambar</label>
                            <div class="d-flex align-items-center justify-content-center border border-2 border-dashed rounded-3 bg-white"
                                style="height: 80px; width: 80px; cursor: pointer;"
                                onclick="document.getElementById('gambarInputLaporan').click();">
                                <i class='bx bx-camera-plus fs-2 text-muted'></i>
                                <input type="file" id="gambarInputLaporan" name="gambar" class="d-none"
                                    accept="image/*">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold text-uppercase">
                            Tambahkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Tab Styling */
        .nav-tabs .nav-link {
            border: none;
            color: #566a7f;
            border-bottom: 2px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: #696cff;
            /* Red underline like in mockup */
            background: transparent;
        }

        /* Modal Fullscreen Header */
        .modal-fullscreen .modal-header {
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .modal-fullscreen .modal-body {
            overflow-y: auto;
        }

        /* Input Styling */
        .form-control:focus,
        .form-select:focus {
            border-color: #696cff;
            box-shadow: 0 0 0 0.1rem rgba(105, 108, 255, 0.25);
        }

        /* Multi-select styling */
        select[multiple] {
            height: auto;
            min-height: 100px;
        }
    </style>
@endpush
