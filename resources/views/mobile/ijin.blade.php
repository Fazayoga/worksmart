@extends('layouts.mobile')

@section('title', 'Ijin')

@section('content')
    <div class="mobile-header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/img/avatars/1.png') }}" alt="Avatar"
                class="rounded-circle border border-2 border-white" style="width: 35px; height: 35px; background: white;">
            <span class="h5 mb-0 text-white fw-bold">Ijin</span>
        </div>
        <div class="dropdown">
            <button class="btn p-0 text-white" type="button" data-bs-toggle="dropdown">
                <i class='bx bx-dots-vertical-rounded fs-4'></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.close();">Exit</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid py-3">
        <!-- Red Action Button -->
        <button type="button" class="btn btn-danger w-100 mb-3 py-2 fw-bold"
            style="background-color: #ff6b6b; border: none;" data-bs-toggle="modal" data-bs-target="#formPengajuanModal">
            Pengajuan Lain
        </button>

        <!-- Empty State / List -->
        <div class="alert alert-warning border-0 shadow-sm text-center py-4"
            style="background-color: #fff9db; color: #856404; font-size: 0.9rem;">
            Anda Belum Pernah Mengajukan Ijin/Cuti.
        </div>
    </div>

    <!-- Modal Form Pengajuan -->
    <div class="modal fade" id="formPengajuanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white py-2">
                    <h5 class="modal-title text-white fs-6">Form Pengajuan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold">Alasan Ijin</label>
                            <select class="form-select form-select-sm" name="alasan">
                                <option value="">Pilih</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Ijin">Ijin</option>
                                <option value="Cuti">Cuti</option>
                                <option value="Dinas">Dinas</option>
                            </select>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold">Tanggal Mulai</label>
                            <input type="date" class="form-control form-control-sm" name="tanggal_mulai"
                                placeholder="yyyy-mm-dd">
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold">Lama Hari</label>
                            <select class="form-select form-select-sm" name="durasi">
                                <option value="">Pilih</option>
                                <option value="1">1 Hari</option>
                                <option value="2">2 Hari</option>
                                <option value="3">3 Hari</option>
                                <option value="4">4 Hari</option>
                                <option value="5">5 Hari</option>
                            </select>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold">Penjelasan Detail</label>
                            <textarea class="form-control form-control-sm" name="keterangan" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold"
                            style="background-color: #ff6b6b; border: none;">
                            Kirim
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Styling for the modal to match image */
        .modal-content {
            border-radius: 8px;
        }

        .modal-header {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .form-label {
            color: #566a7f;
        }

        .form-select,
        .form-control {
            border-color: #d9dee3;
        }
    </style>
@endpush
