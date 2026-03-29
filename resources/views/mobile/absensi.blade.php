@extends('layouts.mobile')

@section('title', 'Absensi')

@section('content')
    <div class="mobile-header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/img/avatars/1.png') }}" alt="Avatar"
                class="rounded-circle border border-2 border-white" style="width: 35px; height: 35px; background: white;">
            <span class="h5 mb-0 text-white fw-bold">Absensi</span>
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

    <div class="container-fluid py-3">
        <div class="row g-3">
            <!-- Masuk/Keluar -->
            <div class="col-6">
                <a href="{{ route('mobile.camera', ['type' => 'Absen Masuk']) }}" class="text-decoration-none">
                    <div class="card attendance-card shadow-sm p-3">
                        <div class="attendance-icon-wrapper text-primary">
                            <i class='bx bx-log-in-circle'></i>
                        </div>
                        <div class="text-center">
                            <span class="card-text-small">Absen Masuk</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('mobile.camera', ['type' => 'Absen Keluar']) }}" class="text-decoration-none">
                    <div class="card attendance-card shadow-sm p-3">
                        <div class="attendance-icon-wrapper text-info">
                            <i class='bx bx-log-out-circle'></i>
                        </div>
                        <div class="text-center">
                            <span class="card-text-small">Absen Keluar</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-6">
                <a href="{{ route('mobile.camera', ['type' => 'Mulai Istirahat']) }}" class="text-decoration-none">
                    <div class="card attendance-card shadow-sm p-3">
                        <div class="attendance-icon-wrapper text-warning" style="background-color: #fff9e6;">
                            <i class='bx bx-coffee-togo'></i>
                        </div>
                        <div class="text-center">
                            <span class="card-text-small">Mulai Istirahat</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('mobile.camera', ['type' => 'Selesai Istirahat']) }}" class="text-decoration-none">
                    <div class="card attendance-card shadow-sm p-3">
                        <div class="attendance-icon-wrapper text-danger" style="background-color: #ffebeb;">
                            <i class='bx bx-bell'></i>
                        </div>
                        <div class="text-center">
                            <span class="card-text-small">Selesai Istirahat</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Lembur -->
            <div class="col-6">
                <a href="javascript:void(0);" class="text-decoration-none" data-bs-toggle="modal"
                    data-bs-target="#keteranganModal" onclick="setModalTitle('Mulai Lembur')">
                    <div class="card attendance-card shadow-sm p-3">
                        <div class="attendance-icon-wrapper text-secondary">
                            <i class='bx bx-timer'></i>
                        </div>
                        <div class="text-center">
                            <span class="card-text-small">Mulai Lembur</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a href="javascript:void(0);" class="text-decoration-none" data-bs-toggle="modal"
                    data-bs-target="#keteranganModal" onclick="setModalTitle('Selesai Lembur')">
                    <div class="card attendance-card shadow-sm p-3">
                        <div class="attendance-icon-wrapper text-secondary">
                            <i class='bx bx-stopwatch'></i>
                        </div>
                        <div class="text-center">
                            <span class="card-text-small">Selesai Lembur</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Kegiatan -->
            <div class="col-6">
                <a href="javascript:void(0);" class="text-decoration-none" data-bs-toggle="modal"
                    data-bs-target="#keteranganKegiatanModal" onclick="setKegiatanModalTitle('Mulai Kegiatan')">
                    <div class="card attendance-card shadow-sm p-3">
                        <div class="attendance-icon-wrapper text-primary">
                            <i class='bx bx-briefcase'></i>
                        </div>
                        <div class="text-center">
                            <span class="card-text-small">Mulai Kegiatan</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a href="javascript:void(0);" class="text-decoration-none" data-bs-toggle="modal"
                    data-bs-target="#keteranganKegiatanModal" onclick="setKegiatanModalTitle('Selesai Kegiatan')">
                    <div class="card attendance-card shadow-sm p-3">
                        <div class="attendance-icon-wrapper text-primary">
                            <i class='bx bx-briefcase-alt'></i>
                        </div>
                        <div class="text-center">
                            <span class="card-text-small">Selesai Kegiatan</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Dinas -->
            <div class="col-6">
                <a href="javascript:void(0);" class="text-decoration-none" data-bs-toggle="modal"
                    data-bs-target="#keteranganModal" onclick="setModalTitle('Mulai Dinas')">
                    <div class="card attendance-card shadow-sm p-3">
                        <div class="attendance-icon-wrapper text-success" style="background-color: #e8fadf;">
                            <i class='bx bx-buildings'></i>
                        </div>
                        <div class="text-center">
                            <span class="card-text-small">Mulai Dinas</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a href="javascript:void(0);" class="text-decoration-none" data-bs-toggle="modal"
                    data-bs-target="#keteranganModal" onclick="setModalTitle('Selesai Dinas')">
                    <div class="card attendance-card shadow-sm p-3">
                        <div class="attendance-icon-wrapper text-success" style="background-color: #e8fadf;">
                            <i class='bx bx-building-house'></i>
                        </div>
                        <div class="text-center">
                            <span class="card-text-small">Selesai Dinas</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Footer Icons -->
            {{-- <div class="col-6">
                <a href="#" class="text-decoration-none">
                    <div class="card attendance-card shadow-sm p-3">
                        <div class="attendance-icon-wrapper text-danger">
                            <i class='bx bx-receipt'></i>
                        </div>
                        <div class="text-center">
                            <span class="card-text-small">Reimbursement</span>
                        </div>
                    </div>
                </a>
            </div> --}}
            <div class="col-12">
                <a href="{{ route('mobile.riwayat') }}" class="text-decoration-none">
                    <div class="card attendance-card shadow-sm p-3">
                        <div class="attendance-icon-wrapper text-warning">
                            <i class='bx bx-history'></i>
                        </div>
                        <div class="text-center">
                            <span class="card-text-small">Riwayat Absensi</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Modal Keterangan -->
    <div class="modal fade" id="keteranganModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered px-4">
            <div class="modal-content border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-header border-0 pb-0 justify-content-center pt-4">
                    <h5 class="modal-title fw-bold text-dark" id="keteranganModalLabel">Keterangan</h5>
                </div>
                <div class="modal-body pt-3">
                    <hr class="mt-0 mb-3 opacity-10">
                    <form action="#" method="POST" id="keteranganForm">
                        @csrf
                        <input type="hidden" name="type" id="attendance_type">
                        <div class="mb-4">
                            <textarea class="form-control border-0 shadow-none" name="keterangan" rows="4"
                                placeholder="Ketik keterangan di sini..."
                                style="background-color: #f2f2f2; border-radius: 15px; padding: 15px; resize: none; font-size: 0.9rem;"></textarea>
                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col-6">
                                <button type="button" class="btn w-100 py-2 fw-bold" data-bs-dismiss="modal"
                                    style="background-color: #f2f2f2; color: #333; border-radius: 12px; font-size: 0.95rem;">
                                    BATAL
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn w-100 py-2 fw-bold bg-primary text-white">
                                    KIRIM
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Keterangan Kegiatan -->
    <div class="modal fade" id="keteranganKegiatanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered px-4">
            <div class="modal-content border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-header border-0 pb-0 justify-content-center pt-4">
                    <h5 class="modal-title fw-bold text-dark">Keterangan Kegiatan</h5>
                </div>
                <div class="modal-body pt-3">
                    <hr class="mt-0 mb-3 opacity-10">
                    <form action="#" method="POST" id="keteranganKegiatanForm">
                        @csrf
                        <input type="hidden" name="type" id="kegiatan_attendance_type">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark mb-2">Keperluan</label>
                            <select class="form-select border-1" name="keperluan"
                                style="border-radius: 12px; padding: 12px; font-size: 0.9rem;">
                                <option value="" selected disabled>Pilih Kegiatan</option>
                                <option value="Survey">Survey</option>
                                <option value="Meeting">Meeting</option>
                                <option value="Instalasi">Instalasi</option>
                                <option value="Maintenance">Maintenance</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-dark mb-2">Keterangan</label>
                            <textarea class="form-control border-0 shadow-none" name="keterangan" rows="4"
                                placeholder="Ketik keterangan di sini..."
                                style="background-color: #f2f2f2; border-radius: 15px; padding: 15px; resize: none; font-size: 0.9rem;"></textarea>
                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col-6">
                                <button type="button" class="btn w-100 py-2 fw-bold" data-bs-dismiss="modal"
                                    style="background-color: #f2f2f2; color: #333; border-radius: 12px; font-size: 0.95rem;">
                                    BATAL
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn w-100 py-2 fw-bold bg-primary text-white"
                                    style="border-radius: 12px; font-size: 0.95rem;">
                                    KIRIM
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function setModalTitle(title) {
            document.getElementById('attendance_type').value = title;
        }

        function setKegiatanModalTitle(title) {
            document.getElementById('kegiatan_attendance_type').value = title;
        }
    </script>
@endpush
