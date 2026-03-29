@extends('layouts.app')

@section('title', 'Absen')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class='bx bx-check-square fs-4'></i>
            </div>
            <div>
                <h5 class="mb-0">Absen</h5>
                <small class="text-muted">Log aktivitas absensi terbaru</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Absen
                </li>
            </ol>
        </nav>
    </div>

    <div class="card overflow-hidden">
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                @foreach ($paginatedData as $item)
                    <div class="list-group-item list-group-item-action border-0 py-3 px-4">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-start">
                                <div class="avatar avatar-md me-3">
                                    <span class="avatar-initial rounded-circle bg-label-primary">{{ $item['avatar'] }}</span>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark mb-0">{{ $item['nama'] }}</div>
                                    <div class="text-primary small mb-1" style="font-size: 0.85rem;">{{ $item['perusahaan'] }}</div>
                                    <div class="text-muted small">{{ $item['status'] }}</div>
                                </div>
                            </div>
                            <div class="text-end">
                                <small class="text-muted" style="font-size: 0.75rem;">{{ $item['timestamp'] }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if($paginatedData->hasPages())
        <div class="card-footer bg-transparent border-top py-3">
            <div class="d-flex justify-content-end">
                {{ $paginatedData->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
@endsection
