@extends('layouts.app')

@section('title', 'Manajemen Jabatan & Akses')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class='bx bx-user-check fs-4'></i>
            </div>
            <div>
                <h5 class="mb-0">Manajemen Jabatan dan Akses Modul</h5>
                <small class="text-muted">Kelola jabatan dan hak akses menu</small>
            </div>
        </div>
        <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJabatanModal">
                <i class="bx bx-plus me-1"></i> Tambah Jabatan
            </button>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 250px">Jabatan & Divisi</th>
                        <th>Akses Modul Tersemat</th>
                        <th style="width: 150px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jabatan as $j)
                        <tr>
                            <td>
                                <div class="fw-bold text-primary">{{ $j->nama_jabatan }}</div>
                                <small class="text-muted">{{ $j->divisi?->nama_divisi ?? 'Tanpa Divisi' }}</small>
                            </td>
                            <td>
                                @if(Str::lower($j->nama_jabatan) == 'administrator')
                                    <span class="badge bg-label-success fs-tiny uppercase">Semua Akses Terbuka</span>
                                @else
                                    <div class="d-flex flex-wrap gap-1">
                                        @forelse($j->akses as $ak)
                                            <span class="badge bg-label-info fs-tiny" style="text-transform: capitalize;">{{ str_replace('-', ' ', $ak->menu_slug) }}</span>
                                        @empty
                                            <span class="badge bg-label-secondary fs-tiny">Tidak Ada Akses</span>
                                        @endforelse
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <button class="btn btn-icon btn-outline-primary btn-sm btn-edit" 
                                        data-id="{{ $j->id }}" 
                                        data-nama="{{ $j->nama_jabatan }}" 
                                        data-divisi="{{ $j->divisi_id }}"
                                        data-akses="{{ json_encode($j->akses->pluck('menu_slug')) }}">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>
                                    @if(Str::lower($j->nama_jabatan) != 'administrator')
                                        <button class="btn btn-icon btn-outline-danger btn-sm btn-delete" data-id="{{ $j->id }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Add Jabatan -->
    <div class="modal fade" id="addJabatanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('Jabatan-Akses.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header border-bottom">
                    <h5 class="modal-title">Tambah Jabatan & Hak Akses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Jabatan</label>
                            <input type="text" name="nama_jabatan" class="form-control" placeholder="Contoh: Manager Operasional" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Divisi / Departemen</label>
                            <select name="divisi_id" class="form-select" required>
                                <option value="">Pilih Divisi</option>
                                @foreach($divisi as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <h6 class="fw-bold mb-3"><i class="bx bx-shield-quarter me-1"></i> Pengaturan Hak Akses Menu</h6>
                    <div class="row g-3">
                        @foreach($menus as $slug => $label)
                            <div class="col-md-4 col-sm-6">
                                <div class="form-check custom-option custom-option-basic">
                                    <label class="form-check-label custom-option-content" for="add-check-{{ $slug }}">
                                        <input class="form-check-input" type="checkbox" name="menus[]" value="{{ $slug }}" id="add-check-{{ $slug }}">
                                        <span class="custom-option-header">
                                            <span class="h6 mb-0">{{ $label }}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Jabatan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Jabatan -->
    <div class="modal fade" id="editJabatanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editJabatanForm" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header border-bottom">
                    <h5 class="modal-title">Edit Jabatan & Hak Akses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Jabatan</label>
                            <input type="text" name="nama_jabatan" id="edit_nama_jabatan" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Divisi / Departemen</label>
                            <select name="divisi_id" id="edit_divisi_id" class="form-select" required>
                                @foreach($divisi as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3"><i class="bx bx-shield-quarter me-1"></i> Pengaturan Hak Akses Menu</h6>
                    <div class="row g-3">
                        @foreach($menus as $slug => $label)
                            <div class="col-md-4 col-sm-6">
                                <div class="form-check custom-option custom-option-basic">
                                    <label class="form-check-label custom-option-content" for="edit-check-{{ $slug }}">
                                        <input class="form-check-input menu-checkbox" type="checkbox" name="menus[]" value="{{ $slug }}" id="edit-check-{{ $slug }}">
                                        <span class="custom-option-header">
                                            <span class="h6 mb-0">{{ $label }}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Edit Button Click
            $('.btn-edit').on('click', function() {
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                const divisi = $(this).data('divisi');
                const akses = $(this).data('akses'); // Ini adalah array slug
                
                $('#edit_nama_jabatan').val(nama);
                $('#edit_divisi_id').val(divisi);
                
                // Reset kabeh checkbox
                $('.menu-checkbox').prop('checked', false);
                
                // Centang sing ono neng data akses
                if(akses && Array.isArray(akses)) {
                    akses.forEach(slug => {
                        $(`#edit-check-${slug}`).prop('checked', true);
                    });
                }

                $('#editJabatanForm').attr('action', `/Jabatan-Akses/${id}`);
                $('#editJabatanModal').modal('show');
            });

            // Delete Button Click
            $('.btn-delete').on('click', function() {
                const id = $(this).data('id');
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Menghapus jabatan akan berdampak pada pegawai yang memiliki jabatan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/Jabatan-Akses/${id}`,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire('Dihapus!', response.message, 'success').then(() => location.reload());
                            },
                            error: function(xhr) {
                                Swal.fire('Gagal!', xhr.responseJSON?.message || 'Terjadi kesalahan.', 'error');
                            }
                        });
                    }
                });
            });
        });

        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 2000, showConfirmButton: false });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: '{{ session('error') }}' });
        @endif
    </script>
@endpush
