@extends('layouts.mobile')

@section('title', 'Riwayat Absensi Kegiatan')

@section('content')
    <style>
        .riwayat-header {
            color: white;
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-tabs-riwayat {
            border-bottom: 2px solid #eee;
            background: white;
            position: sticky;
            top: 56px;
            z-index: 999;
        }

        .nav-tabs-riwayat .nav-link {
            border: none;
            color: #666;
            font-weight: 600;
            padding: 12px 0;
            text-align: center;
            flex: 1;
            font-size: 0.9rem;
            text-transform: uppercase;
            position: relative;
        }

        .nav-tabs-riwayat .nav-link.active {
            color: #ff8c00;
            background: none;
        }

        .nav-tabs-riwayat .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #ff8c00;
        }

        .riwayat-card {
            background: white;
            border-radius: 12px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 15px;
            border: 1px solid #edf2f7;
        }

        .riwayat-date-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
            position: relative;
            padding-bottom: 8px;
        }

        .riwayat-date-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1.5px;
            background-color: #00ccb1;
            opacity: 0.5;
        }

        .riwayat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            font-size: 0.95rem;
            color: #444;
        }

        .riwayat-time {
            font-weight: 700;
            color: #000;
        }

        .riwayat-detail {
            font-size: 0.85rem;
            color: #777;
            margin-top: -4px;
        }
    </style>

    <div class="riwayat-header bg-primary d-flex align-items-center gap-3">
        <a href="{{ route('selfie-absen') }}" class="text-white">
            <i class='bx bx-chevron-left fs-2'></i>
        </a>
        <h5 class="mb-0 fw-bold text-white">Riwayat Absensi Kegiatan</h5>
    </div>

    <nav class="nav nav-tabs-riwayat d-flex">
        <a class="nav-link active" data-bs-toggle="tab" href="#absensi">Absensi</a>
        <a class="nav-link" data-bs-toggle="tab" href="#kegiatan">Kegiatan</a>
    </nav>

    <div class="container-fluid py-3 tab-content">
        <!-- Section Absensi -->
        <div class="tab-pane fade show active" id="absensi">
            <!-- Day 1 -->
            <div class="riwayat-card">
                <div class="riwayat-date-title">Rabu, 25 Maret 2026</div>
                <div class="text-muted small py-2">Tidak ada catatan</div>
            </div>

            <!-- Day 2 -->
            <div class="riwayat-card">
                <div class="riwayat-date-title">Selasa, 24 Maret 2026</div>
                <div class="text-muted small py-2">Tidak ada catatan</div>
            </div>

            <!-- Day 3 -->
            <div class="riwayat-card">
                <div class="riwayat-date-title">Rabu, 11 Maret 2026</div>
                <div class="riwayat-item">
                    <span>Absen Masuk</span>
                    <span class="riwayat-time">07:00:00</span>
                </div>
            </div>

            <!-- Day 4 -->
            <div class="riwayat-card">
                <div class="riwayat-date-title">Senin, 9 Maret 2026</div>
                <div class="riwayat-item">
                    <span>Absen Masuk</span>
                    <span class="riwayat-time">15:02:35</span>
                </div>
            </div>

            <!-- Day 5 -->
            <div class="riwayat-card">
                <div class="riwayat-date-title">Kamis, 26 Februari 2026</div>
                <div class="riwayat-item">
                    <span>Absen Masuk</span>
                    <span class="riwayat-time">15:56:53</span>
                </div>
                <div class="riwayat-item">
                    <span>Absen Keluar</span>
                    <span class="riwayat-time">19:27:20</span>
                </div>
            </div>

            <!-- Day 6 -->
            <div class="riwayat-card">
                <div class="riwayat-date-title">Senin, 23 Februari 2026</div>
                <div class="riwayat-item border-bottom pb-1 mb-1 border-light">
                    <span>Absen Masuk</span>
                    <span class="riwayat-time">18:36:34</span>
                </div>
                <div class="riwayat-item">
                    <span>Absen Keluar</span>
                    <span class="riwayat-time">12:09:01</span>
                </div>
            </div>
        </div>

        <!-- Section Kegiatan -->
        <div class="tab-pane fade" id="kegiatan">
            <!-- Day 1 -->
            <div class="riwayat-card">
                <div class="riwayat-date-title">27 Januari 2026</div>
                <div class="riwayat-item">
                    <div>
                        <div>Mulai Dinas NULL '-'</div>
                    </div>
                    <span class="riwayat-time">08:47:19</span>
                </div>
            </div>

            <!-- Day 2 -->
            <div class="riwayat-card">
                <div class="riwayat-date-title">20 Januari 2026</div>
                <div class="riwayat-item">
                    <div>
                        <div>Selesai Dinas Private Class 'ttt'</div>
                    </div>
                    <span class="riwayat-time">15:24:14</span>
                </div>
            </div>

            <!-- Day 3 -->
            <div class="riwayat-card">
                <div class="riwayat-date-title">10 Desember 2025</div>
                <div class="riwayat-item">
                    <div>
                        <div>Mulai Dinas Private Class 'ttt'</div>
                    </div>
                    <span class="riwayat-time">23:50:22</span>
                </div>
            </div>

            <!-- Day 4 -->
            <div class="riwayat-card">
                <div class="riwayat-date-title">04 Desember 2025</div>
                <div class="riwayat-item border-bottom pb-1 mb-1 border-light">
                    <div>Selesai Dinas kedinasan 'bxgdhggsyhh'</div>
                </div>
                <div class="riwayat-item border-bottom pb-1 mb-1 border-light">
                    <div>Mulai Dinas kedinasan 'bxgdhggsyhh'</div>
                </div>
                <div class="riwayat-item">
                    <div>Selesai Dinas Rapat 'rapat pleno'</div>
                </div>
                <div class="d-flex justify-content-end mt-1">
                    <span class="riwayat-time">11:55:08</span>
                </div>
                <!-- Note: The mockup shows times on the right, but multiple items in one day -->
                <!-- I'll adjust the layout to be more flexible for multiple items -->
            </div>

            <!-- Adjusting Day 4 layout to match exactly -->
            <div class="riwayat-card">
                <div class="riwayat-date-title">04 Desember 2025</div>
                <div class="riwayat-item">
                    <span>Selesai Dinas kedinasan 'bxgdhgg...'</span>
                    <span class="riwayat-time">11:55:08</span>
                </div>
                <div class="riwayat-item">
                    <span>Mulai Dinas kedinasan 'bxgdhgg...'</span>
                    <span class="riwayat-time">11:51:28</span>
                </div>
                <div class="riwayat-item">
                    <span>Selesai Dinas Rapat 'rapat pl...'</span>
                    <span class="riwayat-time">11:50:46</span>
                </div>
            </div>

            <!-- Day 5 -->
            <div class="riwayat-card">
                <div class="riwayat-date-title">02 Desember 2025</div>
                <div class="riwayat-item">
                    <span>Mulai Dinas Rapat 'rapat pleno'</span>
                    <span class="riwayat-time">10:25:44</span>
                </div>
            </div>
        </div>
    </div>
@endsection
