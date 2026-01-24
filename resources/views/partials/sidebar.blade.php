@php
    // Tentukan app aktif
    $activeApp = 'absensi'; // default

    if (
        request()->is(
            'pegawai*',
            'ijin-cuti*',
            'broadcast*',
            'data-absensi*',
            'absen-disetujui*',
            'reimbursement*',
            'traking*',
            'data-pinjaman*',
            'angsuran*',
            'jatuh-tempo*',
        )
    ) {
        $activeApp = 'absensi';
    }
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo position-relative">
        <a href="{{ url('/') }}" class="app-brand-link d-flex align-items-center">
            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="WorkSmart" style="height: 25px;">
            <span class="app-brand-text demo menu-text fw-bold ms-2">WorkSmart</span>
        </a>
        <!-- Tombol toggle desktop -->
        <a href="javascript:void(0);" id="desktopMenuToggle" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left align-middle"></i>
        </a>
        <!-- Tombol mobile -->
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
            <i class="bx bx-chevron-left align-middle"></i>
        </a>
    </div>
    <div class="menu-divider mt-0"></div>
    <div class="menu-inner-shadow"></div>
    <div class="px-3 py-2">
        <div class="card-body p-2">
            <div class="dropdown w-100">
                <button
                    class="btn w-100 d-flex align-items-center justify-content-between px-3 py-2 rounded-3
                    bg-light border-0 shadow-none"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex align-items-center gap-2">
                        <span class="d-flex align-items-center justify-content-center rounded-3 bg-primary text-white"
                            style="width:32px;height:32px">
                            <i class="bx bx-check-square"></i>
                        </span>

                        <div class="text-start lh-sm">
                            <div class="fw-semibold text-capitalize">{{ $activeApp }}</div>
                            <small class="text-muted">Aplikasi Aktif</small>
                        </div>
                    </div>
                    <i class="bx bx-chevron-down text-muted"></i>
                </button>
                <ul class="dropdown-menu w-100 mt-2 border-0 shadow rounded-4 p-2">
                    <!-- ABSENSI -->
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="dropdown-item d-flex align-items-center gap-3 rounded-3 px-3 py-2
                                {{ $activeApp === 'absensi' ? 'active bg-primary text-white' : '' }}">

                            <span
                                class="d-flex align-items-center justify-content-center rounded-3
                                    {{ $activeApp === 'absensi' ? 'bg-white text-primary' : 'bg-light text-primary' }}"
                                style="width:32px;height:32px">
                                <i class="bx bx-check-square"></i>
                            </span>

                            <div>
                                <div class="fw-semibold">Absensi</div>
                                <small class="{{ $activeApp === 'absensi' ? 'text-white-50' : 'text-muted' }}">
                                    Kehadiran & izin
                                </small>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider my-2">
                    </li>
                    <!-- PLUGIN -->
                    <li>
                        <a href="#"
                            class="dropdown-item d-flex align-items-center gap-3 rounded-3 px-3 py-2 text-muted">
                            <span class="d-flex align-items-center justify-content-center rounded-3 bg-light"
                                style="width:32px;height:32px">
                                <i class="bx bx-plus-circle"></i>
                            </span>
                            <div>
                                <div class="fw-semibold">Tambah Plugin</div>
                                <small class="text-muted">Aktifkan modul baru</small>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboards">Dashboard</div>
                <span class="badge rounded-pill bg-danger ms-auto">5</span>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('pegawai') ? 'active' : '' }}">
            <a href="{{ route('pegawai') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div class="text-truncate">Pegawai</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('ijin-cuti') ? 'active' : '' }}">
            <a href="{{ route('ijin-cuti') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                <div class="text-truncate">Ijin / Cuti</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('Slip-Gaji') ? 'active' : '' }}">
            <a href="{{ route('Slip-Gaji') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
                <div class="text-truncate">Slip Gaji</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('broadcast') ? 'active' : '' }}">
            <a href="{{ route('broadcast') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-broadcast"></i>
                <div class="text-truncate">Broadcast</div>
            </a>
        </li>
        <li
            class="menu-item {{ request()->is('data-absensi*', 'absen-disetujui*', 'reimbursement*', 'traking*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-check-square"></i>
                <div class="text-truncate">Absensi</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('data-absensi*') ? 'active' : '' }}">
                    <a href="{{ route('data-absensi') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user-check"></i>
                        <div class="text-truncate">Data Absensi</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('absen-disetujui*') ? 'active' : '' }}">
                    <a href="{{ url('absen-disetujui') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-check-circle"></i>
                        <div class="text-truncate">Persetujuan</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('reimbursement*') ? 'active' : '' }}">
                    <a href="{{ url('reimbursement') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-receipt"></i>
                        <div class="text-truncate">Reimbursement</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('traking*') ? 'active' : '' }}">
                    <a href="{{ url('traking') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-current-location"></i>
                        <div class="text-truncate">Treking Lokasi</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item 
            {{ request()->routeIs('tugas-saya', 'manajemen-laporan', 'calender') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div class="text-truncate">Tugas</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('tugas-saya') ? 'active' : '' }}">
                    <a href="{{ route('tugas-saya') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-briefcase"></i>
                        <div class="text-truncate">Tugas Saya</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('manajemen-laporan') ? 'active' : '' }}">
                    <a href="{{ route('manajemen-laporan') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-file"></i>
                        <div class="text-truncate">Laporan Saya</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('calender') ? 'active' : '' }}">
                    <a href="{{ route('calender') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-calendar"></i>
                        <div class="text-truncate">Calender</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item {{ request()->routeIs('data-pinjaman', 'angsuran', 'jatuh-tempo') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div class="text-truncate">Pinjaman</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('data-pinjaman') ? 'active' : '' }}">
                    <a href="{{ route('data-pinjaman') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div class="text-truncate">Data Pinjaman</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('angsuran') ? 'active' : '' }}">
                    <a href="{{ route('angsuran') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-credit-card"></i>
                        <div class="text-truncate">Angsuran</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('jatuh-tempo') ? 'active' : '' }}">
                    <a href="{{ route('jatuh-tempo') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-calendar-exclamation"></i>
                        <div class="text-truncate">Jatuh Tempo</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item {{ request()->routeIs('Laporan-Absensi', 'Gaji', 'Ijin-Cuti', 'Reimbursement', 'Kepegawaian') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div class="text-truncate">Laporan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('Laporan-Absensi') ? 'active' : '' }}">
                    <a href="{{ route('Laporan-Absensi') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-clipboard"></i>
                        <div class="text-truncate">Absensi</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('Gaji') ? 'active' : '' }}">
                    <a href="{{ route('Gaji') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-money"></i>
                        <div class="text-truncate">Gaji</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('Ijin-Cuti') ? 'active' : '' }}">
                    <a href="{{ route('Ijin-Cuti') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                        <div class="text-truncate">Ijin / Cuti</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('Reimbursement') ? 'active' : '' }}">
                    <a href="{{ route('Reimbursement') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-receipt"></i>
                        <div class="text-truncate">Reimbursement</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('Kepegawaian') ? 'active' : '' }}">
                    <a href="{{ route('Kepegawaian') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-id-card"></i>
                        <div class="text-truncate">Kepegawaian</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item {{ request()->routeIs(
                'Jabatan-Akses',
                'Lokasi-Absensi',
                'Jam-Kerja',
                'Perusahaan',
                'Potongan-Tunjangan',
                'Riwayat-Login',
            )
                ? 'active open'
                : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div class="text-truncate">Setting</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('Jabatan-Akses') ? 'active' : '' }}">
                    <a href="{{ route('Jabatan-Akses') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user-check"></i>
                        <div class="text-truncate">Jabatan & Akses</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('Lokasi-Absensi') ? 'active' : '' }}">
                    <a href="{{ route('Lokasi-Absensi') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-map-pin"></i>
                        <div class="text-truncate">Lokasi Absensi</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('Jam-Kerja') ? 'active' : '' }}">
                    <a href="{{ route('Jam-Kerja') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-time-five"></i>
                        <div class="text-truncate">Status Jam Kerja</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('Perusahaan') ? 'active' : '' }}">
                    <a href="{{ route('Perusahaan') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-building"></i>
                        <div class="text-truncate">Edit Perusahaan</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('Potongan-Tunjangan') ? 'active' : '' }}">
                    <a href="{{ route('Potongan-Tunjangan') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-money-withdraw"></i>
                        <div class="text-truncate">Potongan & Tunjangan</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ request()->routeIs('Riwayat-Login') ? 'active' : '' }}">
            <a href="{{ route('Riwayat-Login') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-mobile"></i>
                <div class="text-truncate">Riwayat Login</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('Billing') ? 'active' : '' }}">
            <a href="{{ route('Billing') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dollar"></i>
                <div class="text-truncate">Billing</div>
            </a>
        </li>
    </ul>
</aside>
