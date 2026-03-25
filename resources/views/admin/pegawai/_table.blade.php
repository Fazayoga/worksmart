@forelse ($pegawai as $row)
    <tr data-status="{{ $row->is_active ? 'aktif' : 'nonaktif' }}">
        <td>
            <div class="d-flex align-items-center gap-2">
                <img src="{{ $row->user->avatar ? asset('storage/' . $row->user->avatar) : asset('assets/img/avatars/1.png') }}"
                    class="rounded-circle" width="32">
                <span>{{ $row->user->name ?? 'N/A' }}</span>
            </div>
        </td>
        <td>{{ $row->user->email ?? 'N/A' }}</td>
        <td>{{ $row->jabatan->nama_jabatan ?? 'N/A' }}</td>
        <td>
            <span class="badge bg-label-{{ $row->is_active ? 'success' : 'secondary' }}">
                {{ $row->is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
        </td>
        <td>{{ $row->tanggal_masuk ? $row->tanggal_masuk->format('d M Y') : '-' }}</td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-warning edit-pegawai" data-id="{{ $row->id }}"
                data-name="{{ $row->user->name }}" data-email="{{ $row->user->email }}" data-nik="{{ $row->nik }}"
                data-no_hp="{{ $row->no_hp_1 }}" data-divisi="{{ $row->divisi_id }}"
                data-jabatan="{{ $row->jabatan_id }}" data-shift="{{ $row->shift_id }}"
                data-gaji="{{ (int) $row->gaji_pokok }}" data-cuti="{{ $row->jatah_cuti }}"
                data-tanggal_masuk="{{ $row->tanggal_masuk ? $row->tanggal_masuk->format('Y-m-d') : '' }}"
                data-tanggal_selesai="{{ $row->tanggal_berakhir_kontrak ? $row->tanggal_berakhir_kontrak->format('Y-m-d') : '' }}"
                data-status_karyawan="{{ $row->status_karyawan }}" data-status="{{ $row->is_active ? '1' : '0' }}">
                <i class="bx bx-edit"></i>
            </button>
            @if ($row->is_active)
                <button class="btn btn-sm btn-danger delete-pegawai" data-id="{{ $row->id }}" title="Nonaktifkan">
                    <i class="bx bx-user-x"></i>
                </button>
            @else
                <button class="btn btn-sm btn-success reactivate-pegawai" data-id="{{ $row->id }}"
                    title="Aktifkan Kembali">
                    <i class="bx bx-user-check"></i>
                </button>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-4">Belum ada data pegawai.</td>
    </tr>
@endforelse
