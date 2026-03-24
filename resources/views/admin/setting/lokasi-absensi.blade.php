@extends('layouts.app')

@section('title', 'Manajemen Lokasi Kantor / Cabang')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        .map-container {
            height: 400px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ddd;
            z-index: 1;
        }
        .search-map-box {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            width: 80%;
        }
    </style>
@endpush

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-map-pin fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Lokasi Absensi</h5>
                <small class="text-muted">Manajemen Lokasi Kantor / Cabang</small>
            </div>
        </div>

        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Manajemen Lokasi Kantor / Cabang
                </li>
            </ol>
        </nav>
    </div>

    {{-- SETTINGS & TABLE --}}
    <div class="card">
        <div class="card-header border-bottom">
            <div class="row align-items-center g-3">
                <div class="col-md-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input setting-toggle" type="checkbox" id="switchRadius" data-setting="radius" {{ $settings['is_within_radius'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="switchRadius">
                            Wajib Dalam Jangkauan
                        </label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input setting-toggle" type="checkbox" id="switchSelfie" data-setting="selfie" {{ $settings['is_selfie'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="switchSelfie">
                            Wajib Foto Selfie
                        </label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input setting-toggle" type="checkbox" id="switchStandby" data-setting="standby" {{ $settings['is_standby'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="switchStandby">
                            Wajib Standby Kantor
                        </label>
                    </div>
                </div>

                <div class="col-md-3 text-md-end">
                    <button class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#addLokasiModal">
                        <i class="bx bx-plus me-1"></i> Tambah Lokasi
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama Lokasi</th>
                        <th>Alamat Lengkap</th>
                        <th class="text-center">Radius</th>
                        <th class="text-center">Zona Waktu</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lokasi as $row)
                        <tr>
                            <td class="fw-bold text-primary">{{ $row->nama_lokasi }}</td>
                            <td>{{ $row->alamat ?? '-' }}</td>
                            <td class="text-center">{{ $row->radius_meter }}M</td>
                            <td class="text-center">{{ $row->zona_waktu ?? 'WIB' }}</td>
                            <td class="text-center">
                                <span class="badge bg-label-{{ $row->is_active ? 'success' : 'secondary' }}">
                                    {{ $row->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm edit-lokasi" 
                                    data-id="{{ $row->id }}"
                                    data-nama="{{ $row->nama_lokasi }}"
                                    data-alamat="{{ $row->alamat }}"
                                    data-lat="{{ $row->latitude }}"
                                    data-lng="{{ $row->longitude }}"
                                    data-radius="{{ $row->radius_meter }}"
                                    data-zona="{{ $row->zona_waktu }}">
                                    <i class="bx bx-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm delete-lokasi" data-id="{{ $row->id }}">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada data lokasi absensi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addLokasiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('Lokasi-Absensi.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title py-1">Tambah Lokasi Kantor / Cabang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4">
                            <!-- Left: Form -->
                            <div class="col-md-6 border-end pr-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-muted">NAMA LOKASI</label>
                                    <input type="text" name="nama_lokasi" class="form-control" required placeholder="Contoh: Kantor Pusat">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted">RADIUS</label>
                                        <select name="radius_meter" class="form-select" required>
                                            <option value="5">5 Meter</option>
                                            <option value="10">10 Meter</option>
                                            <option value="20">20 Meter</option>
                                            <option value="50" selected>50 Meter</option>
                                            <option value="100">100 Meter</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted">ZONA WAKTU</label>
                                        <select name="zona_waktu" class="form-select" required>
                                            <option value="WIB" selected>WIB (Jakarta)</option>
                                            <option value="WITA">WITA (Bali/Makassar)</option>
                                            <option value="WIT">WIT (Maluku/Papua)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label fw-bold small text-muted">ALAMAT LENGKAP</label>
                                    <textarea name="alamat" id="add_alamat_text" class="form-control" rows="6" placeholder="Masukkan alamat lengkap..."></textarea>
                                </div>
                                
                                <input type="hidden" name="latitude" id="add_lat">
                                <input type="hidden" name="longitude" id="add_lng">
                            </div>

                            <!-- Right: Map -->
                            <div class="col-md-6 position-relative">
                                <div class="input-group search-map-box shadow-none">
                                    <input type="text" id="add_search_input" class="form-control border-end-0" placeholder="Cari Alamat/Gedung...">
                                    <button class="btn btn-outline-info" type="button" id="add_search_btn">
                                        <i class="bx bx-search"></i>
                                    </button>
                                </div>
                                <div id="add_map" class="map-container shadow-sm border-0"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between p-3">
                        <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary px-5">Simpan Data Lokasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editLokasiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form id="editLokasiForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title py-1">Edit Lokasi Kantor / Cabang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4">
                            <!-- Left: Form -->
                            <div class="col-md-6 border-end pr-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-muted">NAMA LOKASI</label>
                                    <input type="text" name="nama_lokasi" id="edit_nama" class="form-control" required>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted">RADIUS</label>
                                        <select name="radius_meter" id="edit_radius" class="form-select" required>
                                            <option value="5">5 Meter</option>
                                            <option value="10">10 Meter</option>
                                            <option value="20">20 Meter</option>
                                            <option value="50">50 Meter</option>
                                            <option value="100">100 Meter</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted">ZONA WAKTU</label>
                                        <select name="zona_waktu" id="edit_zona" class="form-select" required>
                                            <option value="WIB">WIB (Jakarta)</option>
                                            <option value="WITA">WITA (Bali/Makassar)</option>
                                            <option value="WIT">WIT (Maluku/Papua)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label fw-bold small text-muted">ALAMAT LENGKAP</label>
                                    <textarea name="alamat" id="edit_alamat" class="form-control" rows="6"></textarea>
                                </div>
                                
                                <input type="hidden" name="latitude" id="edit_lat">
                                <input type="hidden" name="longitude" id="edit_lng">
                            </div>

                            <!-- Right: Map -->
                            <div class="col-md-6 position-relative">
                                <div class="input-group search-map-box shadow-none">
                                    <input type="text" id="edit_search_input" class="form-control border-end-0" placeholder="Cari Alamat/Gedung...">
                                    <button class="btn btn-outline-info" type="button" id="edit_search_btn">
                                        <i class="bx bx-search"></i>
                                    </button>
                                </div>
                                <div id="edit_map" class="map-container shadow-sm border-0"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between p-3">
                        <button type="button" class="btn btn-kembali px-4" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-simpan px-5">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        $(document).ready(function() {
            // Maps Vars
            let addMap, addMarker, editMap, editMarker;
            const defaultLat = -6.200000;
            const defaultLng = 106.816666;

            // Initialize Add Map
            function initAddMap() {
                if (!addMap) {
                    addMap = L.map('add_map').setView([defaultLat, defaultLng], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(addMap);

                    addMarker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(addMap);
                    
                    $('#add_lat').val(defaultLat);
                    $('#add_lng').val(defaultLng);

                    addMarker.on('dragend', function(e) {
                        const position = addMarker.getLatLng();
                        $('#add_lat').val(position.lat.toFixed(7));
                        $('#add_lng').val(position.lng.toFixed(7));
                        reverseGeocode(position.lat, position.lng, '#add_alamat_text');
                    });
                }
                setTimeout(() => { addMap.invalidateSize(); }, 500);
            }

            // Initialize Edit Map
            function initEditMap(lat, lng) {
                if (!editMap) {
                    editMap = L.map('edit_map').setView([lat, lng], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(editMap);

                    editMarker = L.marker([lat, lng], { draggable: true }).addTo(editMap);

                    editMarker.on('dragend', function(e) {
                        const position = editMarker.getLatLng();
                        $('#edit_lat').val(position.lat.toFixed(7));
                        $('#edit_lng').val(position.lng.toFixed(7));
                        reverseGeocode(position.lat, position.lng, '#edit_alamat');
                    });
                } else {
                    editMap.setView([lat, lng], 13);
                    editMarker.setLatLng([lat, lng]);
                }
                setTimeout(() => { editMap.invalidateSize(); }, 500);
            }

            // Reverse Geocode (Address Lookup)
            function reverseGeocode(lat, lng, targetInput) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.display_name) {
                            $(targetInput).val(data.display_name);
                        }
                    });
            }

            // Search Address
            function searchAddress(inputSelector, mapObj, markerObj, latInput, lngInput, addrInput) {
                const query = $(inputSelector).val();
                if (!query) return;

                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            const lat = data[0].lat;
                            const lon = data[0].lon;
                            const zoom = 15;
                            
                            mapObj.setView([lat, lon], zoom);
                            markerObj.setLatLng([lat, lon]);
                            
                            $(latInput).val(lat);
                            $(lngInput).val(lon);
                            $(addrInput).val(data[0].display_name);
                        } else {
                            Swal.fire('Oops', 'Alamat tidak ditemukan', 'error');
                        }
                    });
            }

            // Search Buttons
            $('#add_search_btn').on('click', () => searchAddress('#add_search_input', addMap, addMarker, '#add_lat', '#add_lng', '#add_alamat_text'));
            $('#edit_search_btn').on('click', () => searchAddress('#edit_search_input', editMap, editMarker, '#edit_lat', '#edit_lng', '#edit_alamat'));

            // Handlers for Map Initialization
            $('#addLokasiModal').on('shown.bs.modal', function() {
                initAddMap();
            });

            $('.edit-lokasi').on('click', function() {
                const id = $(this).data('id');
                const lat = parseFloat($(this).data('lat')) || defaultLat;
                const lng = parseFloat($(this).data('lng')) || defaultLng;
                
                $('#edit_nama').val($(this).data('nama'));
                $('#edit_alamat').val($(this).data('alamat'));
                $('#edit_lat').val(lat);
                $('#edit_lng').val(lng);
                $('#edit_radius').val($(this).data('radius'));
                $('#edit_zona').val($(this).data('zona') || 'WIB');

                $('#editLokasiForm').attr('action', `/Lokasi-Absensi/${id}`);
                $('#editLokasiModal').modal('show');
                
                setTimeout(() => { initEditMap(lat, lng); }, 200);
            });

            // AJAX Update Settings
            $('.setting-toggle').on('change', function() {
                const setting = $(this).data('setting');
                const value = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: "{{ route('Lokasi-Absensi.update-settings') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        setting: setting,
                        value: value
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Tersimpan',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat memperbarui pengaturan.',
                        });
                        $(this).prop('checked', !value);
                    }
                });
            });

            // Delete Confirmation
            $('.delete-lokasi').on('click', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data lokasi akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `/Lokasi-Absensi/${id}`;
                        form.innerHTML = `@csrf @method('DELETE')`;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });

            // Flash Messages
            @if(session('success'))
                Swal.fire({ 
                    icon: 'success', 
                    title: 'Berhasil!', 
                    text: "{{ session('success') }}", 
                    timer: 2000, 
                    showConfirmButton: false 
                });
            @endif
        });
    </script>
@endpush
