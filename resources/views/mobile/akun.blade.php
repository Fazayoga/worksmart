@extends('layouts.mobile')

@section('title', 'Akun Saya')

@section('content')
    <div class="mobile-header d-flex align-items-center justify-content-between" style="background-color: #696cff;">
        <div class="d-flex align-items-center gap-2">
            <span class="h5 mb-0 text-white fw-bold">Akun Saya</span>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="text-center mb-4">
            <div class="position-relative d-inline-block">
                <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/img/avatars/1.png') }}" alt="Avatar"
                    class="rounded-circle border border-4 border-white shadow"
                    style="width: 100px; height: 100px; object-fit: cover;">
                <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle p-2 shadow-sm"
                    style="width: 32px; height: 32px;">
                    <i class='bx bx-camera small'></i>
                </button>
            </div>
            <h4 class="mt-3 mb-0 fw-bold text-dark">{{ Auth::user()->name }}</h4>
            <p class="text-muted small">{{ Auth::user()->email }}</p>
        </div>

        <div class="card border-0 shadow-sm mb-4 overflow-hidden"
            style="border-radius: 15px; background: linear-gradient(135deg, #696cff 0%, #3f42ff 100%);">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-white fw-bold mb-0">Kinerja (Tahun ini)</h6>
                    <span class="badge bg-white text-primary rounded-pill px-2 py-1 small fw-bold">1,250 Point</span>
                </div>
                <div class="row g-2">
                    <div class="col-4">
                        <div class="p-2 bg-white bg-opacity-10 rounded text-center text-black h-100">
                            <div class="small opacity-75" style="font-size: 0.65rem;">Jatah Cuti</div>
                            <div class="h6 fw-bold mb-0">12</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 bg-white bg-opacity-10 rounded text-center text-black h-100">
                            <div class="small opacity-75" style="font-size: 0.65rem;">Pakai Cuti</div>
                            <div class="h6 fw-bold mb-0">2</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 bg-white bg-opacity-10 rounded text-center text-black h-100">
                            <div class="small opacity-75" style="font-size: 0.65rem;">Total Izin</div>
                            <div class="h6 fw-bold mb-0">3</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 bg-white bg-opacity-10 rounded text-center text-black h-100">
                            <div class="small opacity-75" style="font-size: 0.65rem;">Total Alpha</div>
                            <div class="h6 fw-bold mb-0">0</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 bg-white bg-opacity-10 rounded text-center text-black h-100">
                            <div class="small opacity-75" style="font-size: 0.65rem;">On Time</div>
                            <div class="h6 fw-bold mb-0">156</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 bg-white bg-opacity-10 rounded text-center text-black h-100">
                            <div class="small opacity-75" style="font-size: 0.65rem;">Lateness</div>
                            <div class="h6 fw-bold mb-0">14</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <div class="list-group list-group-flush" style="border-radius: 15px;">
                <a href="#"
                    class="list-group-item list-group-item-action py-3 d-flex align-items-center justify-content-between border-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-label-primary p-2 rounded" style="background-color: #e7e7ff; color: #696cff;">
                            <i class='bx bx-user fs-4'></i>
                        </div>
                        <span class="fw-semibold">Edit Profil</span>
                    </div>
                    <i class='bx bx-chevron-right text-muted'></i>
                </a>
                <a href="#"
                    class="list-group-item list-group-item-action py-3 d-flex align-items-center justify-content-between border-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-label-secondary p-2 rounded" style="background-color: #f5f5f9; color: #8592a3;">
                            <i class='bx bx-money fs-4'></i>
                        </div>
                        <span class="fw-semibold">Pinjaman</span>
                    </div>
                    <i class='bx bx-chevron-right text-muted'></i>
                </a>
                <a href="#"
                    class="list-group-item list-group-item-action py-3 d-flex align-items-center justify-content-between border-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-label-info p-2 rounded" style="background-color: #d7f5fc; color: #03c3ec;">
                            <i class='bx bx-broadcast fs-4'></i>
                        </div>
                        <span class="fw-semibold">Broadcast</span>
                        <span class="badge bg-danger rounded-circle p-1 ms-1" style="width: 8px; height: 8px;"> </span>
                    </div>
                    <i class='bx bx-chevron-right text-muted'></i>
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <div class="list-group list-group-flush" style="border-radius: 15px;">
                <a href="#"
                    class="list-group-item list-group-item-action py-3 d-flex align-items-center justify-content-between border-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-label-success p-2 rounded" style="background-color: #e8fadf; color: #71dd37;">
                            <i class='bx bx-lock-alt fs-4'></i>
                        </div>
                        <span class="fw-semibold">Ubah Password</span>
                    </div>
                    <i class='bx bx-chevron-right text-muted'></i>
                </a>
                <a href="#"
                    class="list-group-item list-group-item-action py-3 d-flex align-items-center justify-content-between border-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-label-warning p-2 rounded" style="background-color: #fff2e2; color: #ffab00;">
                            <i class='bx bx-bell fs-4'></i>
                        </div>
                        <span class="fw-semibold">Notifikasi</span>
                    </div>
                    <i class='bx bx-chevron-right text-muted'></i>
                </a>
                <a href="#"
                    class="list-group-item list-group-item-action py-3 d-flex align-items-center justify-content-between border-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-label-info p-2 rounded" style="background-color: #d7f5fc; color: #03c3ec;">
                            <i class='bx bx-help-circle fs-4'></i>
                        </div>
                        <span class="fw-semibold">Pusat Bantuan</span>
                    </div>
                    <i class='bx bx-chevron-right text-muted'></i>
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <div class="list-group list-group-flush" style="border-radius: 15px;">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="list-group-item list-group-item-action py-3 d-flex align-items-center justify-content-between border-0 rounded-p-15">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-label-danger p-2 rounded" style="background-color: #ffe5e5; color: #ff3e1d;">
                            <i class='bx bx-log-out fs-4'></i>
                        </div>
                        <span class="fw-semibold text-danger">Logout</span>
                    </div>
                    <i class='bx bx-chevron-right text-danger'></i>
                </a>
            </div>
        </div>
    </div>
@endsection
