@extends('layouts.app')

@section('title', 'Rangking Poin')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <!-- KIRI : Icon + Title -->
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:48px;height:48px">
                <i class='bx bx-trophy fs-4'></i>
            </div>
            <div>
                <h5 class="mb-0">Rangking Poin</h5>
                <small class="text-muted">Peringkat karyawan berdasarkan perolehan poin</small>
            </div>
        </div>

        <!-- KANAN : Breadcrumb -->
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Rangking Poin
                </li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 100px;">Peringkat</th>
                        <th>Karyawan</th>
                        <th>Perusahaan</th>
                        <th class="text-end" style="width: 150px;">Jumlah Poin</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($paginatedData as $index => $item)
                        <tr>
                            <td class="text-center">
                                @php
                                    $rank = ($paginatedData->currentPage() - 1) * $paginatedData->perPage() + $index + 1;
                                @endphp
                                @if ($rank == 1)
                                    <span class="badge bg-label-warning px-3 py-2">1</span>
                                @elseif($rank == 2)
                                    <span class="badge bg-label-secondary px-3 py-2">2</span>
                                @elseif($rank == 3)
                                    <span class="badge bg-label-danger px-3 py-2" style="background-color: #cd7f32 !important; color: white !important;">3</span>
                                @else
                                    <span class="fw-bold">{{ $rank }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-3">
                                        <span class="avatar-initial rounded-circle bg-label-primary">{{ substr($item['nama'], 0, 1) }}</span>
                                    </div>
                                    <div class="fw-bold">{{ $item['nama'] }}</div>
                                </div>
                            </td>
                            <td>{{ $item['perusahaan'] }}</td>
                            <td class="text-end">
                                <span class="badge bg-label-success fs-6">{{ number_format($item['poin'], 0, ',', '.') }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-transparent border-top-0 py-3">
            <div class="d-flex justify-content-end">
                {{ $paginatedData->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

