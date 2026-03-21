@extends('layouts.app')

@section('title', 'Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}" />
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        {{-- ================= LEFT SIDE ================= --}}
        <div class="col-lg-3 mb-4">

            {{-- CARD ATAS --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">

                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/img/avatars/1.png') }}" 
                        class="rounded-circle img-fluid mb-3 shadow-sm border"
                        style="width:130px; height:130px; object-fit:cover;">

                    <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                    <small class="text-muted d-block">{{ $user->karyawan?->perusahaan->nama_perusahaan ?? 'WorkSmart' }}</small>
                    <small class="text-muted d-block mb-2">{{ $user->karyawan?->divisi->nama_divisi ?? 'Umum' }}</small>

                    <div class="my-3">
                        <span class="fw-bold text-warning">0 Point</span> |
                        <span class="fw-bold text-primary">10 Rekan Kerja</span>
                    </div>

                    {{-- Foto seluruh pegawai --}}
                    <div class="d-flex justify-content-center">
                        <img src="https://via.placeholder.com/100" class="rounded-circle border border-white"
                            width="35">
                        <img src="https://via.placeholder.com/100" class="rounded-circle border border-white ms-n2"
                            width="35">
                        <img src="https://via.placeholder.com/100" class="rounded-circle border border-white ms-n2"
                            width="35">
                        <img src="https://via.placeholder.com/100" class="rounded-circle border border-white ms-n2"
                            width="35">
                    </div>

                </div>
            </div>

            {{-- CARD BAWAH --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold">Personal Information</h6>
                    <p class="text-muted small">
                        Ini adalah deskripsi singkat tentang user. Bisa berisi bio atau informasi lainnya.
                    </p>

                    <hr>

                    <div class="d-flex justify-content-around">
                        <a href="{{ $user->karyawan?->link_facebook ?? '#' }}" target="_blank"><i class="bx bxl-facebook text-primary fs-4"></i></a>
                        <a href="{{ $user->karyawan?->link_twitter ?? '#' }}" target="_blank"><i class="bx bxl-twitter text-info fs-4"></i></a>
                        <a href="{{ $user->karyawan?->link_instagram ?? '#' }}" target="_blank"><i class="bx bxl-instagram text-danger fs-4"></i></a>
                        <a href="{{ $user->karyawan?->link_linkedin ?? '#' }}" target="_blank"><i class="bx bxl-linkedin text-primary fs-4"></i></a>
                        <a href="{{ $user->karyawan?->link_website ?? '#' }}" target="_blank"><i class="bx bx-globe text-secondary fs-4"></i></a>
                    </div>

                    {{-- Database nanti --}}
                    {{--
                    {{ $user->description }}
                    --}}
                </div>
            </div>

        </div>

        {{-- ================= RIGHT SIDE ================= --}}
        <div class="col-lg-9">

            {{-- GRAFIK --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Grafik Poin (Per Minggu)</h6>
                    <canvas id="pointChart" height="100"></canvas>
                </div>
            </div>

            {{-- MENU --}}
            <ul class="nav nav-tabs border-bottom mb-4 flex-nowrap overflow-auto" id="profileTab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active d-flex align-items-center px-3 py-2" data-bs-toggle="tab"
                        data-bs-target="#activity" type="button">
                        <i class="bi bi-activity me-2"></i>
                        Activity
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link d-flex align-items-center px-3 py-2" data-bs-toggle="tab" data-bs-target="#akun"
                        type="button">
                        <i class="bi bi-person me-2"></i>
                        Akun
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link d-flex align-items-center px-3 py-2" data-bs-toggle="tab"
                        data-bs-target="#edit-profile" type="button">
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Profile
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link d-flex align-items-center px-3 py-2" data-bs-toggle="tab"
                        data-bs-target="#password" type="button">
                        <i class="bi bi-lock me-2"></i>
                        Ganti Password
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link d-flex align-items-center px-3 py-2" data-bs-toggle="tab"
                        data-bs-target="#sosmed" type="button">
                        <i class="bi bi-share me-2"></i>
                        Sosial Media
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link text-danger d-flex align-items-center px-3 py-2" data-bs-toggle="tab"
                        data-bs-target="#nonaktif" type="button">
                        <i class="bi bi-person-x me-2"></i>
                        Non-Aktifkan Akun
                    </button>
                </li>

            </ul>

            <div
                class="tab-content border border-top-0 rounded-bottom p-0 bg-transparan border-bottom-0 border-transparan mb-0">

                {{-- ================= ACTIVITY ================= --}}
                <div class="tab-pane fade show active" id="activity">
                    <div class="row">

                        {{-- CARD ACTIVITY --}}
                        <div class="col-lg-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">Activity</h6>

                                    <div class="d-flex mb-3">
                                        <img src="https://via.placeholder.com/100" class="rounded-circle me-3"
                                            width="35" height="35">

                                        <div>
                                            <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                            <small class="text-muted">
                                                01 Maret 2026 | 08:00
                                            </small>
                                            <div class="small">
                                                Absen Masuk
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <img src="https://via.placeholder.com/100" class="rounded-circle me-3"
                                            width="35" height="35">

                                        <div>
                                            <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                            <small class="text-muted">
                                                01 Maret 2026 | 12:00
                                            </small>
                                            <div class="small">
                                                Mulai Istirahat
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Loop database nanti --}}
                                    {{--
                                        @foreach ($activities as $activity)
                                        @endforeach
                                    --}}
                                </div>
                            </div>
                        </div>

                        {{-- CARD PHOTOS --}}
                        <div class="col-md-8">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">Photos</h6>

                                    <div class="row g-2">
                                        @for ($i = 0; $i < 9; $i++)
                                            <div class="col-4">
                                                <img src="https://via.placeholder.com/100" class="img-fluid rounded"
                                                    width="100" height="100">
                                            </div>
                                        @endfor
                                    </div>

                                    {{-- Loop database nanti --}}
                                    {{--
                            @foreach ($photos as $photo)
                            @endforeach
                            --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ================= AKUN ================= --}}
                <div class="tab-pane fade" id="akun">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3 border-bottom pb-2">Pengaturan Akun</h6>
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}"
                                                placeholder="Nama" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}"
                                                placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="mb-3">
                                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/img/avatars/1.png') }}" 
                                                class="rounded-circle img-fluid mb-3 shadow-sm border"
                                                id="avatar-preview"
                                                style="width:150px;height:150px;object-fit:cover;">
                                            <label for="avatar-input" class="btn btn-sm btn-outline-primary d-block w-100">
                                                <i class="bx bx-upload me-1"></i> Pilih Foto Baru
                                            </label>
                                            <input type="file" name="avatar" id="avatar-input" class="form-control d-none" 
                                                onchange="document.getElementById('avatar-preview').src = window.URL.createObjectURL(this.files[0])">
                                            <small class="text-muted mt-2 d-block">JPG, PNG atau GIF. Maks 2MB.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top pt-3 mt-3">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bx bx-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- ================= EDIT PROFILE ================= --}}
                <div class="tab-pane fade" id="edit-profile">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3 border-bottom pb-2">Informasi Detail Karyawan</h6>
                            <form action="{{ route('profile.details.update') }}" method="POST">
                                @csrf
                                <div class="row g-4">
                                    {{-- ================= LEFT SIDE ================= --}}
                                    <div class="col-lg-6">
                                        {{-- Nomor KTP --}}
                                        <div class="mb-3">
                                            <label class="form-label">Nomor KTP</label>
                                            <input type="text" name="no_ktp" class="form-control" placeholder="Nomor KTP" value="{{ $user->karyawan?->no_ktp ?? '' }}">
                                        </div>
                                        {{-- Nomor KK --}}
                                        <div class="mb-3">
                                            <label class="form-label">Nomor KK</label>
                                            <input type="text" name="no_kk" class="form-control" placeholder="Nomor Kartu Keluarga" value="{{ $user->karyawan?->no_kk ?? '' }}">
                                        </div>
                                        {{-- Tempat / Tanggal Lahir --}}
                                        <div class="mb-3">
                                            <label class="form-label">Tempat / Tanggal Lahir</label>
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ $user->karyawan?->tempat_lahir ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ $user->karyawan?->tanggal_lahir ? $user->karyawan?->tanggal_lahir->format('Y-m-d') : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Alamat Tinggal --}}
                                        <div class="mb-3">
                                            <label class="form-label">Alamat Tinggal</label>
                                            <div class="row g-2">
                                                <div class="col-md-4">
                                                    <input type="text" name="alamat_tinggal_provinsi" class="form-control" placeholder="Provinsi" value="{{ $user->karyawan?->alamat_tinggal_provinsi ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="alamat_tinggal_kabupaten" class="form-control" placeholder="Kabupaten" value="{{ $user->karyawan?->alamat_tinggal_kabupaten ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="alamat_tinggal_kecamatan" class="form-control" placeholder="Kecamatan" value="{{ $user->karyawan?->alamat_tinggal_kecamatan ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat Tinggal Lengkap</label>
                                            <textarea name="alamat_tinggal_lengkap" class="form-control" rows="3">{{ $user->karyawan?->alamat_tinggal_lengkap ?? '' }}</textarea>
                                        </div>
                                        {{-- Alamat KTP --}}
                                        <div class="mb-3">
                                            <label class="form-label">Alamat KTP</label>
                                            <div class="row g-2">
                                                <div class="col-md-4">
                                                    <input type="text" name="alamat_ktp_provinsi" class="form-control" placeholder="Provinsi" value="{{ $user->karyawan?->alamat_ktp_provinsi ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="alamat_ktp_kabupaten" class="form-control" placeholder="Kabupaten" value="{{ $user->karyawan?->alamat_ktp_kabupaten ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="alamat_ktp_kecamatan" class="form-control" placeholder="Kecamatan" value="{{ $user->karyawan?->alamat_ktp_kecamatan ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat KTP Lengkap</label>
                                            <textarea name="alamat_ktp_lengkap" class="form-control" rows="3">{{ $user->karyawan?->alamat_ktp_lengkap ?? '' }}</textarea>
                                        </div>
                                        {{-- Nomor Telepon --}}
                                        <div class="mb-3">
                                            <label class="form-label">Nomor Telepon</label>
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <input type="text" name="no_hp_1" class="form-control" placeholder="Nomor Telepon 1" value="{{ $user->karyawan?->no_hp_1 ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="no_hp_2" class="form-control" placeholder="Nomor Telepon 2" value="{{ $user->karyawan?->no_hp_2 ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ================= RIGHT SIDE ================= --}}
                                    <div class="col-lg-6">
                                        {{-- Jenis Kelamin --}}
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <div class="d-flex gap-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-Laki" {{ ($user->karyawan?->jenis_kelamin ?? '') == 'Laki-Laki' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Laki-Laki</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" {{ ($user->karyawan?->jenis_kelamin ?? '') == 'Perempuan' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Perempuan</label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Status --}}
                                        <div class="mb-3">
                                            <label class="form-label">Status Pernikahan</label>
                                            <div class="d-flex flex-wrap gap-3">
                                                @foreach(['Lajang', 'Nikah', 'Janda', 'Duda'] as $status)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status_pernikahan" value="{{ $status }}" {{ ($user->karyawan?->status_pernikahan ?? '') == $status ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $status }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        {{-- Agama --}}
                                        <div class="mb-3">
                                            <label class="form-label">Agama</label>
                                            <div class="d-flex flex-wrap gap-3">
                                                @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha'] as $agama)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="agama" value="{{ $agama }}" {{ ($user->karyawan?->agama ?? '') == $agama ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $agama }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        {{-- Golongan Darah --}}
                                        <div class="mb-3">
                                            <label class="form-label">Golongan Darah</label>
                                            <select name="golongan_darah" class="form-select">
                                                <option value="">Pilih Golongan Darah</option>
                                                @foreach(['O', 'A', 'B', 'AB'] as $gol)
                                                <option value="{{ $gol }}" {{ ($user->karyawan?->golongan_darah ?? '') == $gol ? 'selected' : '' }}>{{ $gol }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- Tinggi / Berat --}}
                                        <div class="mb-3">
                                            <label class="form-label">Tinggi & Berat Badan</label>
                                            <div class="row g-2">
                                                <div class="col-md-6 input-group">
                                                    <input type="number" name="tinggi_badan" class="form-control" placeholder="Tinggi" value="{{ $user->karyawan?->tinggi_badan ?? '' }}">
                                                    <span class="input-group-text">Cm</span>
                                                </div>
                                                <div class="col-md-6 input-group">
                                                    <input type="number" name="berat_badan" class="form-control" placeholder="Berat" value="{{ $user->karyawan?->berat_badan ?? '' }}">
                                                    <span class="input-group-text">Kg</span>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Nama Orang Tua --}}
                                        <div class="mb-3">
                                            <label class="form-label">Nama Orang Tua</label>
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah" value="{{ $user->karyawan?->nama_ayah ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu" value="{{ $user->karyawan?->nama_ibu ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Jumlah Saudara --}}
                                        <div class="mb-3">
                                            <label class="form-label">Jumlah Saudara</label>
                                            <input type="number" name="jumlah_saudara" class="form-control" placeholder="Jumlah Saudara" value="{{ $user->karyawan?->jumlah_saudara ?? '' }}">
                                        </div>
                                        {{-- Kontak Darurat --}}
                                        <div class="mb-3">
                                            <label class="form-label">Kontak Darurat</label>
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <input type="text" name="kontak_darurat_nama" class="form-control" placeholder="Nama" value="{{ $user->karyawan?->kontak_darurat_nama ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="kontak_darurat_hp" class="form-control" placeholder="Nomor HP" value="{{ $user->karyawan?->kontak_darurat_hp ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status Kontak Darurat</label>
                                            <select name="kontak_darurat_status" class="form-select">
                                                <option value="">Pilih Status</option>
                                                @foreach(['Orang Tua', 'Suami / Istri', 'Tetangga', 'Teman', 'Saudara'] as $status_kd)
                                                <option value="{{ $status_kd }}" {{ ($user->karyawan?->kontak_darurat_status ?? '') == $status_kd ? 'selected' : '' }}>{{ $status_kd }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- BUTTON --}}
                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bx bx-save me-1"></i> Simpan Detail Profil
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- ================= PASSWORD ================= --}}
                <div class="tab-pane fade" id="password">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3 border-bottom pb-2">Perbarui Keamanan Password</h6>
                            <form action="{{ route('profile.password.update') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Password Saat Ini</label>
                                    <input type="password" name="old_password" class="form-control" required>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Password Baru</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                    </div>
                                </div>
                                <div class="border-top pt-3 mt-3">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bx bx-lock-open-alt me-1"></i> Perbarui Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- ================= SOSIAL MEDIA ================= --}}
                <div class="tab-pane fade" id="sosmed">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3 border-bottom pb-2">Tautan Sosial Media</h6>
                            <form action="{{ route('profile.details.update') }}" method="POST">
                                @csrf
                                {{-- Facebook --}}
                                <div class="mb-3">
                                    <label class="form-label">Facebook</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white">
                                            <i class="bx bxl-facebook text-primary fs-5"></i>
                                        </span>
                                        <input type="url" name="link_facebook" class="form-control"
                                            placeholder="https://facebook.com/username" value="{{ $user->karyawan?->link_facebook ?? '' }}">
                                    </div>
                                </div>
                                {{-- Twitter --}}
                                <div class="mb-3">
                                    <label class="form-label">Twitter (X)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white">
                                            <i class="bx bxl-twitter text-info fs-5"></i>
                                        </span>
                                        <input type="url" name="link_twitter" class="form-control"
                                            placeholder="https://twitter.com/username" value="{{ $user->karyawan?->link_twitter ?? '' }}">
                                    </div>
                                </div>
                                {{-- Instagram --}}
                                <div class="mb-3">
                                    <label class="form-label">Instagram</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white">
                                            <i class="bx bxl-instagram text-danger fs-5"></i>
                                        </span>
                                        <input type="url" name="link_instagram" class="form-control"
                                            placeholder="https://instagram.com/username" value="{{ $user->karyawan?->link_instagram ?? '' }}">
                                    </div>
                                </div>
                                {{-- LinkedIn --}}
                                <div class="mb-3">
                                    <label class="form-label">LinkedIn</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white">
                                            <i class="bx bxl-linkedin text-primary fs-5"></i>
                                        </span>
                                        <input type="url" name="link_linkedin" class="form-control"
                                            placeholder="https://linkedin.com/in/username" value="{{ $user->karyawan?->link_linkedin ?? '' }}">
                                    </div>
                                </div>
                                {{-- Website --}}
                                <div class="mb-3">
                                    <label class="form-label">Website</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white">
                                            <i class="bx bx-globe text-secondary fs-5"></i>
                                        </span>
                                        <input type="url" name="link_website" class="form-control" placeholder="https://yourwebsite.com" value="{{ $user->karyawan?->link_website ?? '' }}">
                                    </div>
                                </div>
                                {{-- Button --}}
                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bx bx-save me-1"></i> Simpan Tautan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- ================= NON AKTIF ================= --}}
                <div class="tab-pane fade" id="nonaktif">
                    <div class="card shadow-sm border-danger">
                        <div class="card-body text-center">
                            <h6 class="text-danger fw-bold mb-3">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Non-Aktifkan Akun
                            </h6>
                            <div class="border border-danger border-2 rounded p-4 mb-3">
                                <p class="text-danger mb-2">Perhatian:</p>
                                <ul class="text-start small">
                                    <li>Anda akan keluar dari perusahaan.</li>
                                    <li>Semua data akan terhapus.</li>
                                    <li>Pastikan keputusan sudah benar.</li>
                                </ul>
                            </div>
                            <button class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Hapus Akun
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CHART --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('pointChart'), {
            type: 'line',
            data: {
                labels: ['1 Mar', '2 Mar', '3 Mar', '4 Mar', '5 Mar', '6 Maret', '7 Maret'],
                datasets: [{
                        label: 'Point',
                        data: [2, 1, 2, 2, 0, 0, 1],
                        borderColor: 'gold',
                        tension: 0.4
                    },
                    {
                        label: 'Total Absen',
                        data: [1, 2, 1, 3, 2, 4, 0],
                        borderColor: 'blue',
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true
            }
        });
    </script>

@endsection
