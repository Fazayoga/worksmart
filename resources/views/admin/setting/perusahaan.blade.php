@extends('layouts.app')

@section('title', 'Edit Perusahaan')

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class='bx bx-building fs-4'></i>
            </div>
            <div>
                <h5 class="mb-0">Edit Perusahaan</h5>
                <small class="text-muted">Perbarui Informasi Perusahaan</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit Perusahaan
                </li>
            </ol>
        </nav>

    </div>

    <form action="{{ route('Perusahaan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        @if (session('success'))
            <div class="alert alert-success alert-dismissible mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible mb-4" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">

                {{-- INFORMASI UTAMA --}}
                <h6 class="fw-semibold mb-3">Informasi Perusahaan</h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control" value="{{ $perusahaan->nama_perusahaan }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email Perusahaan</label>
                        <input type="email" name="email" class="form-control" value="{{ $perusahaan->email }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Provinsi</label>
                        <input type="text" name="provinsi" class="form-control" value="{{ $perusahaan->provinsi }}" placeholder="Contoh: DI Yogyakarta">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Kabupaten</label>
                        <input type="text" name="kabupaten" class="form-control" value="{{ $perusahaan->kabupaten }}" placeholder="Contoh: Sleman">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control" value="{{ $perusahaan->kecamatan }}" placeholder="Contoh: Ngaglik">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Alamat Perusahaan</label>
                        <textarea name="alamat" class="form-control" rows="2">{{ $perusahaan->alamat }}</textarea>
                    </div>
                </div>

                <hr class="my-4">

                {{-- KONTAK --}}
                <h6 class="fw-semibold mb-3">Kontak & Informasi Tambahan</h6>

                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label">Telepon Perusahaan</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ $perusahaan->no_telp }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">No. HP / WhatsApp</label>
                        <input type="text" name="no_wa" class="form-control" value="{{ $perusahaan->no_wa }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Bidang Industri</label>
                        <input type="text" name="bidang_industri" class="form-control" value="{{ $perusahaan->bidang_industri }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Website Perusahaan</label>
                        <input type="text" name="website" class="form-control" value="{{ $perusahaan->website }}">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Logo / Kartu Perusahaan</label>

                        <div class="d-flex align-items-center gap-3">
                            <!-- PREVIEW -->
                            <img id="previewLogo" class="border rounded {{ $perusahaan->logo ? '' : 'd-none' }}"
                                style="width:90px;height:90px;object-fit:contain" 
                                src="{{ $perusahaan->logo ? asset('storage/' . $perusahaan->logo) : '#' }}" 
                                alt="Preview Logo">

                            <!-- FILE INPUT -->
                            <div class="flex-grow-1">
                                <input type="file" name="logo" class="form-control" accept="image/png, image/jpeg"
                                    onchange="previewImage(this)">
                                <small class="text-muted">
                                    PNG / JPG, maksimal 2MB
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- DESKRIPSI --}}
                <h6 class="fw-semibold mb-3">Deskripsi Perusahaan</h6>

                <textarea name="deskripsi" class="form-control" rows="6" placeholder="Deskripsikan perusahaan secara singkat...">{{ $perusahaan->deskripsi }}</textarea>

                {{-- ACTION --}}
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bx bx-save"></i> Simpan
                    </button>
                </div>

            </div>
        </div>
    </form>

@endsection
<script>
    function previewImage(input) {
        const preview = document.getElementById('previewLogo');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none'); // tampilkan gambar
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
