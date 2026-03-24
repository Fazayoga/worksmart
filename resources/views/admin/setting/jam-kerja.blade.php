@extends('layouts.app')

@section('title', 'Manajemen Status Jam / Shift Kerja')

@push('styles')
    <style>
        .bg-emerald { background-color: #10b981 !important; }
        .btn-emerald { background-color: #10b981 !important; color: white; }
        .btn-emerald:hover { background-color: #059669 !important; color: white; }
        .list-group-item-action:hover { background-color: #f8f9fa; cursor: pointer; }
    </style>
@endpush

@section('content')

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class='bx bx-time-five fs-4'></i>
            </div>
            <div>
                <h5 class="mb-0">Status Jam Kerja</h5>
                <small class="text-muted">Manajemen Status Jam/Shift Kerja</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Manajemen Status Jam/Shift Kerja
                </li>
            </ol>
        </nav>
    </div>
    {{-- TABLE --}}
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs border-bottom">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="bx bx-time me-1"></i> Jadwal Kerja
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bx bx-calendar-event me-1"></i> Kegiatan
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-header">
            <div class="d-flex align-items-center gap-3">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked />
                    <label class="form-check-label" for="flexSwitchCheckDefault">Kalender Nasional</label>
                </div>

                <div class="ms-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addShiftModal">
                        <i class="bx bx-plus me-1"></i> Status Jam Kerja
                    </button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 18%">Nama Jadwal / Shift</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Dispensasi</th>
                        <th style="width: 25%">Hari Kerja</th>
                        <th>Hari Libur</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shifts as $row)
                        <tr>
                            <td class="fw-semibold text-primary">{{ $row->nama_shift }}</td>
                            <td class="text-center text-success fw-bold">{{ \Carbon\Carbon::parse($row->jam_masuk)->format('H:i') }}</td>
                            <td class="text-center text-danger fw-bold">{{ \Carbon\Carbon::parse($row->jam_pulang)->format('H:i') }}</td>
                            <td class="text-center">{{ $row->toleransi_terlambat }} Menit</td>
                            <td>
                                <div class="small fw-bold text-muted">{{ $row->jumlah_hari_kerja }} Hari</div>
                                <div class="small text-muted text-wrap" style="max-width: 250px;">({{ $row->hari_kerja ?? '-' }})</div>
                            </td>
                            <td class="text-center small text-muted">{{ $row->hari_libur ?? '-' }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm edit-shift" 
                                    data-id="{{ $row->id }}"
                                    data-nama="{{ $row->nama_shift }}"
                                    data-masuk="{{ $row->jam_masuk }}"
                                    data-pulang="{{ $row->jam_pulang }}"
                                    data-toleransi="{{ $row->toleransi_terlambat }}"
                                    data-jumlah="{{ $row->jumlah_hari_kerja }}"
                                    data-harikerja="{{ $row->hari_kerja }}"
                                    data-harilibur="{{ $row->hari_libur }}"
                                    data-staff="{{ $row->karyawan->pluck('id')->join(',') }}"
                                    data-staff-names="{{ $row->karyawan->map(fn($k) => $k->user->name)->join(', ') }}">
                                    <i class="bx bx-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm delete-shift" data-id="{{ $row->id }}">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data jadwal/shift kerja.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addShiftModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title py-1">Tambah Status Jam/Shift Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addShiftForm">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small mb-1">Nama Jadwal/Shift Kerja</label>
                            <input type="text" name="nama_shift" class="form-control form-control-lg" placeholder="Contoh: Shift Pagi" required>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-muted small mb-1">Waktu Berangkat</label>
                                <div class="d-flex gap-2">
                                    <select name="jam_masuk_h" class="form-select" required>
                                        @for($i=0; $i<24; $i++) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option> @endfor
                                    </select>
                                    <select name="jam_masuk_m" class="form-select" required>
                                        @for($i=0; $i<60; $i+=5) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option> @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-muted small mb-1">Waktu Pulang</label>
                                <div class="d-flex gap-2">
                                    <select name="jam_pulang_h" class="form-select" required>
                                        @for($i=0; $i<24; $i++) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option> @endfor
                                    </select>
                                    <select name="jam_pulang_m" class="form-select" required>
                                        @for($i=0; $i<60; $i+=5) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option> @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-muted small mb-1">Dispensasi Keterlambatan</label>
                                <select name="toleransi_terlambat" class="form-select" required>
                                    <option value="0">0 Menit</option>
                                    <option value="5">5 Menit</option>
                                    <option value="10">10 Menit</option>
                                    <option value="15">15 Menit</option>
                                    <option value="30">30 Menit</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small mb-1">Jumlah Hari Kerja Dalam 1 Minggu</label>
                            <select name="jumlah_hari_kerja" class="form-select" required>
                                <option value="1">1 Hari</option>
                                <option value="2">2 Hari</option>
                                <option value="3">3 Hari</option>
                                <option value="4">4 Hari</option>
                                <option value="5">5 Hari</option>
                                <option value="6">6 Hari</option>
                                <option value="7">7 Hari</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small mb-1">Hari Kerja Dalam 1 Minggu</label>
                            <div class="d-flex flex-wrap gap-2 hari-kerja-container">
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                    <div class="form-check form-check-inline m-0">
                                        <input class="btn-check" type="checkbox" name="hari_kerja[]" value="{{ $day }}" id="add_hk_{{ $day }}">
                                        <label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="add_hk_{{ $day }}">{{ $day }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small mb-1">Hari Libur Dalam 1 Minggu</label>
                            <div class="d-flex flex-wrap gap-2 hari-libur-container">
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                    <div class="form-check form-check-inline m-0">
                                        <input class="btn-check" type="checkbox" name="hari_libur[]" value="{{ $day }}" id="add_hl_{{ $day }}">
                                        <label class="btn btn-outline-danger btn-sm px-3 rounded-pill" for="add_hl_{{ $day }}">{{ $day }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold text-muted small mb-1">Staff Pilih</label>
                            <div class="mb-2">
                                <input type="text" class="form-control form-control-sm search-staff-list" data-target="staff-list-add" placeholder="Cari nama staff...">
                            </div>
                            <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;" id="staff-list-add">
                                @foreach($all_staff as $s)
                                    <div class="form-check staff-item">
                                        <input class="form-check-input select-staff-checkbox" type="checkbox" name="staff_ids[]" value="{{ $s->id }}" id="staff_add_{{ $s->id }}" data-name="{{ $s->user->name }}">
                                        <label class="form-check-label small" for="staff_add_{{ $s->id }}">
                                            {{ $s->user->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div id="selected_staff_count_add" class="mt-2 text-muted small">0 Staff Terpilih</div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 justify-content-start">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm text-white">
                            <i class="bx bx-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editShiftModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title py-1">Edit Status Jam/Shift Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editShiftForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small mb-1">Nama Jadwal/Shift Kerja</label>
                            <input type="text" name="nama_shift" id="edit_nama" class="form-control form-control-lg" required>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-muted small mb-1">Waktu Berangkat</label>
                                <div class="d-flex gap-2">
                                    <select name="jam_masuk_h" id="edit_masuk_h" class="form-select" required>
                                        @for($i=0; $i<24; $i++) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option> @endfor
                                    </select>
                                    <select name="jam_masuk_m" id="edit_masuk_m" class="form-select" required>
                                        @for($i=0; $i<60; $i+=5) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option> @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-muted small mb-1">Waktu Pulang</label>
                                <div class="d-flex gap-2">
                                    <select name="jam_pulang_h" id="edit_pulang_h" class="form-select" required>
                                        @for($i=0; $i<24; $i++) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option> @endfor
                                    </select>
                                    <select name="jam_pulang_m" id="edit_pulang_m" class="form-select" required>
                                        @for($i=0; $i<60; $i+=5) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option> @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-muted small mb-1">Dispensasi Keterlambatan</label>
                                <select name="toleransi_terlambat" id="edit_toleransi" class="form-select" required>
                                    <option value="0">0 Menit</option>
                                    <option value="5">5 Menit</option>
                                    <option value="10">10 Menit</option>
                                    <option value="15">15 Menit</option>
                                    <option value="30">30 Menit</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small mb-1">Jumlah Hari Kerja Dalam 1 Minggu</label>
                            <select name="jumlah_hari_kerja" id="edit_jumlah" class="form-select" required>
                                <option value="5">5 Hari</option>
                                <option value="6">6 Hari</option>
                                <option value="7">7 Hari</option>
                                <option value="4">4 Hari</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small mb-1">Hari Kerja Dalam 1 Minggu</label>
                            <div class="d-flex flex-wrap gap-2 hari-kerja-container-edit">
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                    <div class="form-check form-check-inline m-0">
                                        <input class="btn-check edit-hk" type="checkbox" name="hari_kerja[]" value="{{ $day }}" id="edit_hk_{{ $day }}">
                                        <label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="edit_hk_{{ $day }}">{{ $day }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small mb-1">Hari Libur Dalam 1 Minggu</label>
                            <div class="d-flex flex-wrap gap-2 hari-libur-container-edit">
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                    <div class="form-check form-check-inline m-0">
                                        <input class="btn-check edit-hl" type="checkbox" name="hari_libur[]" value="{{ $day }}" id="edit_hl_{{ $day }}">
                                        <label class="btn btn-outline-danger btn-sm px-3 rounded-pill" for="edit_hl_{{ $day }}">{{ $day }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold text-muted small mb-1">Staff Pilih</label>
                            <div class="mb-2">
                                <input type="text" class="form-control form-control-sm search-staff-list" data-target="staff-list-edit" placeholder="Cari nama staff...">
                            </div>
                            <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;" id="staff-list-edit">
                                @foreach($all_staff as $s)
                                    <div class="form-check staff-item">
                                        <input class="form-check-input select-staff-checkbox edit-staff-checkbox" type="checkbox" name="staff_ids[]" value="{{ $s->id }}" id="staff_edit_{{ $s->id }}" data-name="{{ $s->user->name }}">
                                        <label class="form-check-label small" for="staff_edit_{{ $s->id }}">
                                            {{ $s->user->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div id="selected_staff_count_edit" class="mt-2 text-muted small">0 Staff Terpilih</div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 justify-content-start">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm text-white">
                            <i class="bx bx-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            let selectedStaff = [];

            // Staff Selection Logic (Client-side Search)
            $('.search-staff-list').on('keyup', function() {
                const q = $(this).val().toLowerCase();
                const target = $(this).data('target');
                $(`#${target} .staff-item`).each(function() {
                    const name = $(this).find('label').text().toLowerCase();
                    $(this).toggle(name.includes(q));
                });
            });

            function updateSelectedCount(modalId) {
                const count = $(modalId).find('.select-staff-checkbox:checked').length;
                $(modalId).find('[id^="selected_staff_count"]').text(`${count} Staff Terpilih`);
            }

            $('.select-staff-checkbox').on('change', function() {
                updateSelectedCount($(this).closest('.modal'));
            });

            // Add Shift
            $('#addShiftForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('jam_masuk', $(this).find('[name="jam_masuk_h"]').val() + ':' + $(this).find('[name="jam_masuk_m"]').val());
                formData.append('jam_pulang', $(this).find('[name="jam_pulang_h"]').val() + ':' + $(this).find('[name="jam_pulang_m"]').val());
                
                // Collect checkbox values
                let hk = [];
                $(this).find('[name="hari_kerja[]"]:checked').each(function() { hk.push($(this).val()); });
                formData.delete('hari_kerja[]'); // Remove original array
                formData.append('hari_kerja', hk.join(', '));
                
                let hl = [];
                $(this).find('[name="hari_libur[]"]:checked').each(function() { hl.push($(this).val()); });
                formData.delete('hari_libur[]'); // Remove original array
                formData.append('hari_libur', hl.join(', '));

                $.ajax({
                    url: "{{ route('Jam-Kerja.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.success) {
                            Swal.fire('Berhasil', res.message, 'success').then(() => location.reload());
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal', xhr.responseJSON.message || 'Terjadi kesalahan', 'error');
                    }
                });
            });

            // Edit Shift
            $('.edit-shift').on('click', function() {
                const id = $(this).data('id');
                const masuk = $(this).data('masuk').split(':');
                const pulang = $(this).data('pulang').split(':');
                const staffIds = $(this).data('staff').toString().split(',').filter(s => s !== "");
                const staffNames = $(this).data('staff-names').split(', ').filter(s => s !== "");

                $('#edit_nama').val($(this).data('nama'));
                $('#edit_masuk_h').val(masuk[0]);
                $('#edit_masuk_m').val(masuk[1]);
                $('#edit_pulang_h').val(pulang[0]);
                $('#edit_pulang_m').val(pulang[1]);
                $('#edit_toleransi').val($(this).data('toleransi'));
                $('#edit_jumlah').val($(this).data('jumlah'));
                
                // Set checkboxes for days
                $('.edit-hk').prop('checked', false);
                const hariKerja = $(this).data('harikerja') ? $(this).data('harikerja').toString().split(', ') : [];
                hariKerja.forEach(day => {
                    $(`#edit_hk_${day}`).prop('checked', true);
                });

                $('.edit-hl').prop('checked', false);
                const hariLibur = $(this).data('harilibur') ? $(this).data('harilibur').toString().split(', ') : [];
                hariLibur.forEach(day => {
                    $(`#edit_hl_${day}`).prop('checked', true);
                });

                // Set staff checkboxes
                $('.edit-staff-checkbox').prop('checked', false);
                const staffIds = $(this).data('staff').toString().split(',').filter(s => s !== "");
                staffIds.forEach(sid => {
                    $(`#staff_edit_${sid}`).prop('checked', true);
                });
                updateSelectedCount('#editShiftModal');

                $('#editShiftForm').attr('action', `/Jam-Kerja/${id}`);
                $('#editShiftModal').modal('show');
            });

            $('#editShiftForm').on('submit', function(e) {
                e.preventDefault();
                const id = $(this).attr('action').split('/').pop();
                const formData = new FormData(this);
                formData.append('jam_masuk', $(this).find('[name="jam_masuk_h"]').val() + ':' + $(this).find('[name="jam_masuk_m"]').val());
                formData.append('jam_pulang', $(this).find('[name="jam_pulang_h"]').val() + ':' + $(this).find('[name="jam_pulang_m"]').val());

                // Collect checkbox values
                let hk = [];
                $(this).find('[name="hari_kerja[]"]:checked').each(function() { hk.push($(this).val()); });
                formData.delete('hari_kerja[]');
                formData.append('hari_kerja', hk.join(', '));
                
                let hl = [];
                $(this).find('[name="hari_libur[]"]:checked').each(function() { hl.push($(this).val()); });
                formData.delete('hari_libur[]');
                formData.append('hari_libur', hl.join(', '));

                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.success) {
                            Swal.fire('Berhasil', res.message, 'success').then(() => location.reload());
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal', xhr.responseJSON.message || 'Terjadi kesalahan', 'error');
                    }
                });
            });

            // Delete Shift
            $('.delete-shift').on('click', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin hapus?',
                    text: "Data jadwal akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/Jam-Kerja/${id}`,
                            method: "DELETE",
                            data: { _token: "{{ csrf_token() }}" },
                            success: function(res) {
                                if (res.success) {
                                    Swal.fire('Terhapus!', res.message, 'success').then(() => location.reload());
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
