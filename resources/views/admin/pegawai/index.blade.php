@extends('layouts.app')

@section('title', 'Pegawai')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pegawai.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class="bx bx-group fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0">Pegawai</h5>
                <small class="text-muted">Kelola data pegawai dan karyawan</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Pegawai
                </li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-header border-bottom">
            <div class="row g-3">

                <!-- PEGAWAI AKTIF -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="pegawai-filter d-flex align-items-center gap-3 p-3 rounded bg-light cursor-pointer"
                        data-status="aktif">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px">
                            <i class="bx bx-user-check fs-5"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Pegawai Aktif</h6>
                            <h5 class="mb-0 fw-semibold">{{ $pegawaiAktif ?? 0 }}</h5>
                        </div>
                    </div>
                </div>

                <!-- PEGAWAI TIDAK AKTIF -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="pegawai-filter d-flex align-items-center gap-3 p-3 rounded bg-light cursor-pointer"
                        data-status="nonaktif">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px">
                            <i class="bx bx-user-x fs-5"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Pegawai Tidak Aktif</h6>
                            <h5 class="mb-0 fw-semibold">{{ $pegawaiNonaktif ?? 0 }}</h5>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="card-header border-bottom">
            <div class="row g-2 align-items-center">

                <!-- KIRI : ACTION -->
                <div class="col-12 col-lg-6">
                    <div class="d-flex flex-column flex-sm-row gap-2">

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addPegawaiModal">
                            <i class="bx bx-user-plus me-1"></i>
                            <span class="d-none d-sm-inline">Tambah Pegawai</span>
                            <span class="d-inline d-sm-none">Tambah</span>
                        </button>
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#importPegawaiModal">
                            <i class="bx bx-upload me-1"></i>
                            <span class="d-none d-sm-inline">Import Data</span>
                            <span class="d-inline d-sm-none">Import</span>
                        </button>

                        <button class="btn btn-outline-secondary" id="exportBtn">
                            <i class="bx bx-download me-1"></i>
                            <span class="d-none d-sm-inline">Edit Via Excel</span>
                            <span class="d-inline d-sm-none">Edit</span>
                        </button>

                    </div>
                </div>

                <!-- KANAN : FILTER -->
                <div class="col-12 col-lg-6">
                    <div class="d-flex flex-column flex-md-row gap-2 justify-content-lg-end">

                        <select class="form-select w-100 w-md-auto" id="filterBy">
                            <option value="" selected>Filter Berdasarkan</option>
                            <option value="nama">Nama</option>
                            <option value="divisi">Divisi</option>
                            <option value="jabatan">Jabatan</option>
                        </select>

                        <div class="input-group w-100 w-md-auto">
                            <span class="input-group-text">
                                <i class="bx bx-search"></i>
                            </span>
                            <input type="text" class="form-control" id="searchInput" placeholder="Cari Pegawai...">
                        </div>
                        <!-- SORT ICON -->
                        <button type="button"
                            class="btn btn-outline-secondary d-flex align-items-center justify-content-center"
                            id="sortBtn" data-sort="desc" title="Terbaru">
                            <i class="bx bx-sort-down fs-5"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- TABLE -->
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Tanggal Bergabung</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="employeeTableBody">
                    @include('admin.pegawai._table')
                </tbody>

            </table>
        </div>
    </div>

    <!-- Modal Tambah Pegawai -->
    <div class="modal fade" id="addPegawaiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('pegawai.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pegawai Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-4">
                            <!-- ROW 1 -->
                            <div class="col-md-4">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required placeholder="Email">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" required
                                    placeholder="Nama lengkap">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nomor HP Aktif</label>
                                <input type="text" name="no_hp_aktif" class="form-control"
                                    placeholder="Nomor HP Aktif">
                            </div>

                            <!-- ROW 2 -->
                            <div class="col-md-4">
                                <label class="form-label">Nomor Induk Pegawai (Optional)</label>
                                <div class="input-group">
                                    <input type="text" name="nik" id="nik_input" class="form-control"
                                        placeholder="Nomor Induk Pegawai (Optional)" readonly>
                                    <button class="btn btn-outline-primary" type="button" id="refresh_nik"
                                        title="Refresh NIK">
                                        <i class="bx bx-refresh"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Divisi (Optional)</label>
                                <select name="divisi_id" class="form-select" required>
                                    <option value="" disabled selected>--Pilih Opsi--</option>
                                    @foreach ($divisi as $d)
                                        <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jabatan</label>
                                <select name="jabatan_id" id="add_jabatan" class="form-select" required>
                                    <option value="" disabled selected>--Pilih Opsi--</option>
                                    @foreach ($jabatan as $j)
                                        <option value="{{ $j->id }}" data-nama="{{ $j->nama_jabatan }}">
                                            {{ $j->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- ROW 3 -->
                            <div class="col-md-4">
                                <label class="form-label">Jam Kerja</label>
                                <select name="shift_id" class="form-select">
                                    <option value="" selected>--Pilih Opsi--</option>
                                    @foreach ($shift as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama_shift }}
                                            ({{ \Carbon\Carbon::parse($s->jam_masuk)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($s->jam_pulang)->format('H:i') }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gaji Pokok</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" name="gaji_pokok" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jatah Cuti / Tahun</label>
                                <input type="number" name="jatah_cuti" class="form-control" placeholder="Cuti Pegawai"
                                    value="0">
                            </div>

                            <!-- ROW 4 -->
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Mulai Kerja</label>
                                <input type="date" name="tanggal_masuk" class="form-control" required
                                    value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status Karyawan</label>
                                <select name="status_karyawan" id="add_status_karyawan" class="form-select status-karyawan-select" required>
                                    <option value="tetap">Tetap</option>
                                    <option value="kontrak">Kontrak</option>
                                    <option value="magang">Magang</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Berakhir Kontrak</label>
                                <input type="date" name="tanggal_berakhir_kontrak" id="add_tanggal_berakhir_kontrak" class="form-control contract-date-input">
                            </div>

                            <!-- ROW 5 (PASSWORD) -->
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="add_password" class="form-control"
                                        required placeholder="Minimal 8 karakter">
                                    <button class="btn btn-outline-secondary toggle-password" type="button"
                                        data-target="#add_password">
                                        <i class="bx bx-hide"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Note -->
                        <div class="mt-4 p-3 rounded bg-secondary text-white small">
                            <i class="bx bx-info-circle me-1"></i>
                            * Email dan No HP harus valid karena Pegawai yang ditambahkan akan dikirim email/SMS
                            pemberitahuan serta user dan password untuk login ke aplikasi Kantor Kita. Pastikan pegawai
                            tersebut sudah diberi informasi terlebih dahulu.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pegawai -->
    <div class="modal fade" id="editPegawaiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form id="editPegawaiForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title">Edit Data Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <!-- ROW 1 -->
                            <div class="col-md-4">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="edit_email" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nomor HP Aktif</label>
                                <input type="text" name="no_hp_aktif" id="edit_no_hp" class="form-control">
                            </div>

                            <!-- ROW 2 -->
                            <div class="col-md-4">
                                <label class="form-label">Nomor Induk Pegawai</label>
                                <input type="text" name="nik" id="edit_nik" class="form-control" required
                                    readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Divisi</label>
                                <select name="divisi_id" id="edit_divisi" class="form-select" required>
                                    @foreach ($divisi as $d)
                                        <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jabatan</label>
                                <select name="jabatan_id" id="edit_jabatan" class="form-select" required>
                                    @foreach ($jabatan as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- ROW 3 -->
                            <div class="col-md-4">
                                <label class="form-label">Jam Kerja</label>
                                <select name="shift_id" id="edit_shift" class="form-select">
                                    <option value="">--Pilih Opsi--</option>
                                    @foreach ($shift as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama_shift }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gaji Pokok</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" name="gaji_pokok" id="edit_gaji" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jatah Cuti / Tahun</label>
                                <input type="number" name="jatah_cuti" id="edit_cuti" class="form-control">
                            </div>

                            <!-- ROW 4 -->
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Mulai Kerja</label>
                                <input type="date" name="tanggal_masuk" id="edit_tanggal_masuk" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status Karyawan</label>
                                <select name="status_karyawan" id="edit_status_karyawan" class="form-select status-karyawan-select" required>
                                    <option value="tetap">Tetap</option>
                                    <option value="kontrak">Kontrak</option>
                                    <option value="magang">Magang</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Berakhir Kontrak</label>
                                <input type="date" name="tanggal_berakhir_kontrak" id="edit_tanggal_selesai"
                                    class="form-control">
                            </div>

                            <!-- ROW 5 -->
                            <div class="col-md-4">
                                <label class="form-label">Status Akun</label>
                                <select name="status" id="edit_status" class="form-select" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Password <small class="text-muted">(Kosongkan jika tidak ingin
                                        diubah)</small></label>
                                <div class="input-group">
                                    <input type="password" name="password" id="edit_password" class="form-control"
                                        placeholder="Minimal 8 karakter">
                                    <button class="btn btn-outline-secondary toggle-password" type="button"
                                        data-target="#edit_password">
                                        <i class="bx bx-hide"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Import Pegawai -->
    <div class="modal fade" id="importPegawaiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('pegawai.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Import Data Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Pilih File CSV/Excel</label>
                            <input type="file" name="file" class="form-control" accept=".csv" required>
                            <div class="form-text">Gunakan file .csv sebagai format standar.</div>
                        </div>
                        <div class="p-3 rounded bg-light border">
                            <h6 class="mb-2"><i class="bx bx-info-circle me-1 text-primary"></i> Petunjuk Import:</h6>
                            <ul class="small mb-0 ps-3">
                                <li><strong>NIK</strong>: Pengenal unik. Jika NIK sudah ada, data pegawai tersebut akan diperbarui.</li>
                                <li><strong>Format Tanggal</strong>: Gunakan YYYY-MM-DD (Contoh: 2024-03-25).</li>
                                <li><strong>Password</strong>: Pegawai baru akan memiliki password default: <code>password123</code>.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('pegawai.template') }}" class="btn btn-link me-auto">
                            <i class="bx bx-download me-1"></i> Unduh Template
                        </a>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Mulai Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/pegawai-filter.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Function to toggle contract date input
            function toggleContractDate(statusSelect) {
                const modal = $(statusSelect).closest('.modal');
                const status = $(statusSelect).val();
                const contractDateInput = modal.find('input[name="tanggal_berakhir_kontrak"]');
                
                if (status === 'tetap') {
                    contractDateInput.prop('disabled', true).val('').attr('required', false);
                    contractDateInput.closest('div').addClass('opacity-50');
                } else {
                    contractDateInput.prop('disabled', false).attr('required', true);
                    contractDateInput.closest('div').removeClass('opacity-50');
                }
            }

            // Bind change event to status selects
            $('.status-karyawan-select').on('change', function() {
                toggleContractDate(this);
            });

            // Initial call for Add Modal (reset to default)
            $('#addPegawaiModal').on('show.bs.modal', function() {
                const statusSelect = $(this).find('#add_status_karyawan');
                statusSelect.val('tetap'); // Default to 'tetap'
                toggleContractDate(statusSelect);
            });

            // Search, Filter & Sort Logic
            let searchTimer;
            function performSearch() {
                const q = $('#searchInput').val();
                const filter = $('#filterBy').val();
                const sort = $('#sortBtn').data('sort');
                const status = $('.pegawai-filter.active').data('status');

                $.ajax({
                    url: "{{ route('pegawai') }}",
                    type: "GET",
                    data: { q, filter, sort, status },
                    success: function(html) {
                        $('#employeeTableBody').html(html);
                        // Re-initialize events for new rows
                        initTableEvents();
                    }
                });
            }

            $('#searchInput').on('keyup', function() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(performSearch, 500);
            });

            $('#filterBy').on('change', performSearch);
            
            // Sync with tabs
            $('.pegawai-filter').on('click', function() {
                // The pegawai-filter.js already handles the .active class
                // We just need to trigger the search after a small delay to ensure .active class is set
                setTimeout(performSearch, 50);
            });

            $('#sortBtn').on('click', function() {
                const currentSort = $(this).data('sort');
                const newSort = currentSort === 'desc' ? 'asc' : 'desc';
                $(this).data('sort', newSort);
                $(this).find('i').toggleClass('bx-sort-down bx-sort-up');
                performSearch();
            });

            function initTableEvents() {
                // Edit event
                $('.edit-pegawai').off('click').on('click', function() {
                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    const email = $(this).data('email');
                    const no_hp = $(this).data('no_hp');
                    const nik = $(this).data('nik');
                    const divisi = $(this).data('divisi');
                    const jabatan = $(this).data('jabatan');
                    const shift = $(this).data('shift');
                    const gaji = $(this).data('gaji');
                    const cuti = $(this).data('cuti');
                    const tgl_masuk = $(this).data('tanggal_masuk');
                    const tgl_selesai = $(this).data('tanggal_selesai');
                    const status_karyawan = $(this).data('status_karyawan');
                    const status = $(this).data('status');

                    $('#edit_name').val(name);
                    $('#edit_email').val(email);
                    $('#edit_no_hp').val(no_hp);
                    $('#edit_nik').val(nik);
                    $('#edit_divisi').val(divisi);
                    $('#edit_jabatan').val(jabatan);
                    $('#edit_shift').val(shift);
                    $('#edit_gaji').val(gaji);
                    $('#edit_cuti').val(cuti);
                    $('#edit_tanggal_masuk').val(tgl_masuk);
                    $('#edit_tanggal_selesai').val(tgl_selesai);
                    $('#edit_status_karyawan').val(status_karyawan);
                    $('#edit_status').val(status);

                    $('#editPegawaiForm').attr('action', `/pegawai/${id}`);
                    $('#editPegawaiModal').modal('show');
                    
                    toggleContractDate($('#edit_status_karyawan'));
                });

                // Export / Edit Via Excel Logic
            $('#exportBtn').on('click', function() {
                window.location.href = "{{ route('pegawai.export') }}";
            });

            // Delete/Nonaktifkan event
                $('.delete-pegawai').off('click').on('click', function() {
                    const id = $(this).data('id');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Pegawai ini akan dipindahkan ke daftar Tidak Aktif!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Nonaktifkan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/pegawai/${id}`,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire('Berhasil!', response.message, 'success').then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire('Gagal!', response.message, 'error');
                                    }
                                }
                            });
                        }
                    });
                });

                // Reactivate event
                $('.reactivate-pegawai').off('click').on('click', function() {
                    const id = $(this).data('id');
                    Swal.fire({
                        title: 'Aktifkan Kembali?',
                        text: "Pegawai ini akan dipindahkan kembali ke daftar Aktif!",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Aktifkan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/pegawai/${id}/reactivate`,
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire('Berhasil!', response.message, 'success').then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire('Gagal!', response.message, 'error');
                                    }
                                }
                            });
                        }
                    });
                });
            }

            // Initial call
            initTableEvents();

            // Success Alert
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            @endif

            // Error Alert
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                });
            @endif

            // Open Edit Modal
            $('.edit-pegawai').on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const email = $(this).data('email');
                const no_hp = $(this).data('no_hp');
                const nik = $(this).data('nik');
                const divisi = $(this).data('divisi');
                const jabatan = $(this).data('jabatan');
                const shift = $(this).data('shift');
                const gaji = $(this).data('gaji');
                const cuti = $(this).data('cuti');
                const tgl_masuk = $(this).data('tanggal_masuk');
                const tgl_selesai = $(this).data('tanggal_selesai');
                const status_karyawan = $(this).data('status_karyawan');
                const status = $(this).data('status');

                $('#edit_name').val(name);
                $('#edit_email').val(email);
                $('#edit_no_hp').val(no_hp);
                $('#edit_nik').val(nik);
                $('#edit_divisi').val(divisi);
                $('#edit_jabatan').val(jabatan);
                $('#edit_shift').val(shift);
                $('#edit_gaji').val(gaji);
                $('#edit_cuti').val(cuti);
                $('#edit_tanggal_masuk').val(tgl_masuk);
                $('#edit_tanggal_selesai').val(tgl_selesai);
                $('#edit_status_karyawan').val(status_karyawan);
                $('#edit_status').val(status);

                $('#editPegawaiForm').attr('action', `/pegawai/${id}`);
                $('#editPegawaiModal').modal('show');
                
                // Call toggle after value is set
                toggleContractDate($('#edit_status_karyawan'));
            });

            // Delete Pegawai
            $('.delete-pegawai').on('click', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Pegawai ini akan dipindahkan ke daftar Tidak Aktif!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Nonaktifkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/pegawai/${id}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Berhasil!',
                                        response.message,
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        response.message,
                                        'error'
                                    );
                                }
                            }
                        });
                    }
                });
            });

            // Reactivate Pegawai
            $('.reactivate-pegawai').on('click', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Aktifkan Kembali?',
                    text: "Pegawai ini akan dipindahkan kembali ke daftar Aktif!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Aktifkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/pegawai/${id}/reactivate`,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Berhasil!',
                                        response.message,
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        response.message,
                                        'error'
                                    );
                                }
                            }
                        });
                    }
                });
            });
            // Generate NIK Logic
            function generateNIK() {
                const selectedJabatan = $('#add_jabatan option:selected');
                const jabatanNama = selectedJabatan.data('nama');

                if (!jabatanNama) return;

                // Ambil kata pertama dan jadikan uppercase (ADMIN, STAFF, HRD, dll)
                const prefix = jabatanNama.split(' ')[0].toUpperCase();

                // Generate 5 karakter random alphanumeric
                const randomStr = Math.random().toString(36).substring(2, 7).toUpperCase();

                const nik = `${prefix}-${randomStr}`;
                $('#nik_input').val(nik);
            }

            // Trigger generate on Jabatan change
            $('#add_jabatan').on('change', function() {
                generateNIK();
            });

            // Trigger generate on Refresh click
            $('#refresh_nik').on('click', function() {
                generateNIK();
            });
            // Password Visibility Toggle
            $('.toggle-password').on('click', function() {
                const target = $($(this).data('target'));
                const icon = $(this).find('i');
                if (target.attr('type') === 'password') {
                    target.attr('type', 'text');
                    icon.removeClass('bx-hide').addClass('bx-show');
                } else {
                    target.attr('type', 'password');
                    icon.removeClass('bx-show').addClass('bx-hide');
                }
            });
        });
    </script>
@endpush
