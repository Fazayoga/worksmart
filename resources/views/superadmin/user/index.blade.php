@extends('layouts.app')

@section('title', 'Data User | Superadmin')

@section('content')

    <!-- Top Card -->
    <div class="row mb-4 g-3">
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body py-4 d-flex flex-column align-items-center justify-content-center text-center">
                    <h5 class="fw-bold text-muted mb-2">Pengguna IOS</h5>
                    <h2 class="text-primary fw-bolder mb-0">{{ number_format($totalIos, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body py-4 d-flex flex-column align-items-center justify-content-center text-center">
                    <h5 class="fw-bold text-muted mb-2">Total Pengguna</h5>
                    <h2 class="text-success fw-bolder mb-0">{{ number_format($totalUsers, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h5 class="card-title mb-0">Daftar Semua Pengguna</h5>
            <form action="{{ route('superadmin.user.index') }}" method="GET" class="d-flex w-100 w-md-auto mt-2 mt-md-0">
                <div class="input-group input-group-merge">
                    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Nama / Email..." aria-label="Cari Data" aria-describedby="basic-addon-search31">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    @if(request('search'))
                        <a href="{{ route('superadmin.user.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Tanggal Poin Terakhir Di Dapat</th>
                            <th>Poin Terakhir Di Dapat</th>
                            <th>Nama Perusahaan</th>
                            <th>Total Poin</th>
                            <th>Tanggal Bergabung</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($users as $index => $u)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td><span class="fw-medium">{{ $u->name }}</span></td>
                                <td>{{ $u->email }}</td>
                                <td>-</td> <!-- Optional Poin logic placeholder -->
                                <td>0</td> <!-- Optional Poin logic placeholder -->
                                <td>
                                    @if($u->perusahaan)
                                        <span class="badge bg-label-info">{{ $u->perusahaan->nama_perusahaan }}</span>
                                    @else
                                        <span class="text-muted">Tidak Terhubung</span>
                                    @endif
                                </td>
                                <td>0</td> <!-- Optional Poin logic placeholder -->
                                <td>{{ $u->created_at ? $u->created_at->format('d F Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">Belum ada data pengguna yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer d-flex justify-content-center border-top">
            {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
