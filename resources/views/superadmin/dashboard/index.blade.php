@extends('layouts.app')

@section('title', 'Dapur | Home')

@section('content')

    <!-- ================= CARD ================= -->
    <div class="row g-3 mb-4">
        <!-- Income -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <!-- Kiri (Text) -->
                    <div>
                        <h5 class="fw-bold text-success mb-1">
                            Rp {{ number_format($income ?? 0, 0, ',', '.') }},-
                        </h5>

                        <small class="text-muted">
                            Transaksi Terakhir:
                            {{ $lastIncomeDate ? \Carbon\Carbon::parse($lastIncomeDate)->format('Y-m-d H:i') : '-' }}
                        </small>
                    </div>

                    <!-- Kanan (Icon) -->
                    <div>
                        <i class="bi bi-cash-stack fs-1 text-success"></i>
                    </div>

                </div>
            </div>
        </div>

        <!-- Perusahaan -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold text-warning mb-1">
                            {{ $totalPerusahaan ?? 0 }}
                        </h5>

                        <small class="text-muted">
                            Jumlah Perusahaan
                        </small>
                    </div>
                    <div>
                        <i class="bi bi-building fs-1 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- User -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold text-primary mb-1">
                            {{ $totalUser ?? 0 }}
                        </h5>

                        <small class="text-muted">
                            Jumlah User
                        </small>
                    </div>
                    <div>
                        <i class="bi bi-people fs-1 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= GRAFIK ================= -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h6 class="fw-bold mb-3">Grafik Data Pendaftar (7 Hari Terakhir)</h6>
            <canvas id="chartPendaftar" height="100"></canvas>
        </div>
    </div>

    <!-- ================= NAVIGASI ================= -->
    <ul class="nav nav-tabs mb-4 border-bottom" id="tabMenu">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#perusahaan">
                Perusahaan
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#absen">
                Absen Perusahaan
            </button>
        </li>
    </ul>

    <div class="tab-content p-0 pt-2">

        <!-- ================= TAB PERUSAHAAN ================= -->
        <div class="tab-pane fade show active" id="perusahaan">
            <div class="card shadow-sm border-0">
                {{-- <div class="card-body table-responsive"> --}}
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Perusahaan</th>
                            <th>Total Pengguna</th>
                            <th>Masa Aktif</th>
                            <th>Status</th>
                            <th>Tanggal Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($perusahaanList as $p)
                            <tr>
                                <td>{{ $p->nama_perusahaan }}</td>
                                <td>{{ $p->users_count }}</td>
                                <td>{{ ucfirst($p->subscription_status ?? 'Trial') }}</td>
                                <td>
                                    @if ($p->status == 'Aktif' || $p->status == 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">{{ $p->status ?? 'Tidak Aktif' }}</span>
                                    @endif
                                </td>
                                <td>{{ $p->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data perusahaan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- </div> --}}
            </div>
        </div>

        <!-- ================= TAB ABSEN ================= -->
        <div class="tab-pane fade" id="absen">
            <div class="card shadow-sm border-0">
                {{-- <div class="card-body table-responsive"> --}}
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Perusahaan</th>
                            <th>Total Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absenList as $a)
                            <tr>
                                <td>{{ $a->nama_perusahaan }}</td>
                                <td>{{ $a->total_absen }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">Belum ada data absensi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- </div> --}}
            </div>
        </div>

    </div>

    <!-- ================= CHART JS ================= -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartPendaftar');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_reverse($labels ?? [])) !!},
                datasets: [{
                        label: 'Perusahaan Baru',
                        data: {!! json_encode(array_reverse($dataPerusahaan ?? [])) !!},
                        borderColor: 'yellow',
                        backgroundColor: 'rgba(255, 193, 7, 0.2)',
                        tension: 0.4
                    },
                    {
                        label: 'User Baru',
                        data: {!! json_encode(array_reverse($dataUser ?? [])) !!},
                        borderColor: 'blue',
                        backgroundColor: 'rgba(13, 110, 253, 0.2)',
                        tension: 0.4
                    }
                ]
            }
        });
    </script>

@endsection
