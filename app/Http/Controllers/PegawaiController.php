<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use App\Models\Divisi;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $perusahaan_id = Auth::user()->perusahaan_id;
        $query = $request->input('q');
        $filter = $request->input('filter');
        $sort = $request->input('sort', 'desc');
        $status = $request->input('status');

        $pegawaiQuery = Karyawan::with(['user', 'divisi', 'jabatan'])
            ->where('perusahaan_id', $perusahaan_id);

        if ($status === 'aktif') {
            $pegawaiQuery->where('is_active', true);
        } elseif ($status === 'nonaktif') {
            $pegawaiQuery->where('is_active', false);
        }

        // Search & Filter Logic
        if ($query) {
            if ($filter === 'nama') {
                $pegawaiQuery->whereHas('user', function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                });
            } elseif ($filter === 'divisi') {
                $pegawaiQuery->whereHas('divisi', function($q) use ($query) {
                    $q->where('nama_divisi', 'like', "%{$query}%");
                });
            } elseif ($filter === 'jabatan') {
                $pegawaiQuery->whereHas('jabatan', function($q) use ($query) {
                    $q->where('nama_jabatan', 'like', "%{$query}%");
                });
            } else {
                // Default search (search all relevant fields)
                $pegawaiQuery->where(function($q) use ($query, $pegawaiQuery) {
                    $q->whereHas('user', function($sq) use ($query) {
                        $sq->where('name', 'like', "%{$query}%");
                    })->orWhereHas('divisi', function($sq) use ($query) {
                        $sq->where('nama_divisi', 'like', "%{$query}%");
                    })->orWhereHas('jabatan', function($sq) use ($query) {
                        $sq->where('nama_jabatan', 'like', "%{$query}%");
                    })->orWhere($pegawaiQuery->qualifyColumn('nik'), 'like', "%{$query}%");
                });
            }
        }

        // Sorting
        $pegawaiQuery->orderBy('created_at', $sort);

        $pegawai = $pegawaiQuery->get();

        $divisi = Divisi::where('perusahaan_id', $perusahaan_id)->get();
        $jabatan = Jabatan::where('perusahaan_id', $perusahaan_id)->get();
        $shift = \App\Models\Shift::where('perusahaan_id', $perusahaan_id)->where('is_active', true)->get();

        $pegawaiAktif = Karyawan::where('perusahaan_id', $perusahaan_id)->where('is_active', true)->count();
        $pegawaiNonaktif = Karyawan::where('perusahaan_id', $perusahaan_id)->where('is_active', false)->count();

        // If AJAX request, return table rows only
        if ($request->ajax()) {
            return view('admin.pegawai._table', compact('pegawai'))->render();
        }

        return view('admin.pegawai.index', compact('pegawai', 'pegawaiAktif', 'pegawaiNonaktif', 'divisi', 'jabatan', 'shift'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nik' => 'required|string|max:50',
            'no_hp_aktif' => 'nullable|string|max:20',
            'divisi_id' => 'required|exists:divisi,id',
            'jabatan_id' => 'required|exists:jabatan,id',
            'shift_id' => 'nullable|exists:shift,id',
            'gaji_pokok' => 'nullable|numeric',
            'jatah_cuti' => 'nullable|integer',
            'tanggal_masuk' => 'required|date',
            'tanggal_berakhir_kontrak' => 'nullable|date',
            'status_karyawan' => 'required|in:tetap,kontrak,magang',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'perusahaan_id' => Auth::user()->perusahaan_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status_user' => 'user',
            ]);

            Karyawan::create([
                'perusahaan_id' => Auth::user()->perusahaan_id,
                'user_id' => $user->id,
                'divisi_id' => $request->divisi_id,
                'jabatan_id' => $request->jabatan_id,
                'shift_id' => $request->shift_id,
                'nik' => $request->nik,
                'no_hp_1' => $request->no_hp_aktif,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_berakhir_kontrak' => $request->status_karyawan === 'tetap' ? null : $request->tanggal_berakhir_kontrak,
                'gaji_pokok' => $request->gaji_pokok ?? 0,
                'jatah_cuti' => $request->jatah_cuti ?? 12,
                'status_karyawan' => $request->status_karyawan,
                'is_active' => true,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Pegawai berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan pegawai: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $pegawai = Karyawan::findOrFail($id);
        $user = $pegawai->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nik' => 'required|string|max:50',
            'no_hp_aktif' => 'nullable|string|max:20',
            'divisi_id' => 'required|exists:divisi,id',
            'jabatan_id' => 'required|exists:jabatan,id',
            'shift_id' => 'nullable|exists:shift,id',
            'gaji_pokok' => 'nullable|numeric',
            'jatah_cuti' => 'nullable|integer',
            'tanggal_masuk' => 'required|date',
            'tanggal_berakhir_kontrak' => 'nullable|date',
            'status_karyawan' => 'required|in:tetap,kontrak,magang',
            'status' => 'required|in:1,0',
        ]);

        try {
            DB::beginTransaction();

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->password) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            $pegawai->update([
                'divisi_id' => $request->divisi_id,
                'jabatan_id' => $request->jabatan_id,
                'shift_id' => $request->shift_id,
                'nik' => $request->nik,
                'no_hp_1' => $request->no_hp_aktif,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_berakhir_kontrak' => $request->status_karyawan === 'tetap' ? null : $request->tanggal_berakhir_kontrak,
                'gaji_pokok' => $request->gaji_pokok ?? 0,
                'jatah_cuti' => $request->jatah_cuti ?? 12,
                'status_karyawan' => $request->status_karyawan,
                'is_active' => $request->status,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data pegawai berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $pegawai = Karyawan::findOrFail($id);
            
            // Instead of deleting, we set is_active to false
            $pegawai->update(['is_active' => false]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Pegawai telah dinonaktifkan']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Gagal menonaktifkan pegawai: ' . $e->getMessage()]);
        }
    }

    public function reactivate($id)
    {
        try {
            DB::beginTransaction();
            $pegawai = Karyawan::findOrFail($id);
            $pegawai->update(['is_active' => true]);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Pegawai telah diaktifkan kembali']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Gagal mengaktifkan pegawai: ' . $e->getMessage()]);
        }
    }

    public function exportCsv()
    {
        $perusahaan_id = Auth::user()->perusahaan_id;
        $pegawai = Karyawan::with(['user', 'divisi', 'jabatan'])
            ->where('perusahaan_id', $perusahaan_id)
            ->get();

        $filename = "data_pegawai_" . date('Ymd_His') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['NIK', 'Nama', 'Email', 'Divisi', 'Jabatan', 'Gaji Pokok', 'Jatah Cuti', 'Tanggal Masuk', 'Status Karyawan', 'Tanggal Selesai Kontrak'];

        $callback = function() use($pegawai, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pegawai as $row) {
                fputcsv($file, [
                    $row->nik,
                    $row->user->name ?? '',
                    $row->user->email ?? '',
                    $row->divisi->nama_divisi ?? '',
                    $row->jabatan->nama_jabatan ?? '',
                    $row->gaji_pokok,
                    $row->jatah_cuti,
                    $row->tanggal_masuk ? $row->tanggal_masuk->format('Y-m-d') : '',
                    $row->status_karyawan,
                    $row->tanggal_berakhir_kontrak ? $row->tanggal_berakhir_kontrak->format('Y-m-d') : '',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function downloadTemplate()
    {
        $filename = "template_import_pegawai.csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];
        $columns = ['NIK', 'Nama', 'Email', 'Divisi', 'Jabatan', 'Gaji Pokok', 'Jatah Cuti', 'Tanggal Masuk', 'Status Karyawan', 'Tanggal Selesai Kontrak'];

        $callback = function() use($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt'
        ]);

        $perusahaan_id = Auth::user()->perusahaan_id;
        $file = $request->file('file');
        $data = array_map('str_getcsv', file($file->getPathname()));
        $header = array_shift($data);

        try {
            DB::beginTransaction();

            foreach ($data as $row) {
                if (count($row) < 5) continue; // Skip incomplete rows

                $nik = $row[0];
                $name = $row[1];
                $email = $row[2];
                $divisiName = $row[3];
                $jabatanName = $row[4];
                $gaji = $row[5] ?? 0;
                $cuti = $row[6] ?? 12;
                $tglMasuk = $row[7] ?? date('Y-m-d');
                $statusKaryawan = strtolower($row[8] ?? 'tetap');
                $tglSelesai = !empty($row[9]) ? $row[9] : null;

                // Find or Create Divisi/Jabatan
                $divisi = Divisi::firstOrCreate(['perusahaan_id' => $perusahaan_id, 'nama_divisi' => $divisiName]);
                $jabatan = Jabatan::firstOrCreate(['perusahaan_id' => $perusahaan_id, 'nama_jabatan' => $jabatanName]);

                // Find existing employee by NIK within the company
                $pegawai = Karyawan::where('perusahaan_id', $perusahaan_id)->where('nik', $nik)->first();

                if ($pegawai) {
                    // Update existing
                    $user = $pegawai->user;
                    if ($user) {
                        $user->update(['name' => $name, 'email' => $email]);
                    }
                    
                    $pegawai->update([
                        'divisi_id' => $divisi->id,
                        'jabatan_id' => $jabatan->id,
                        'gaji_pokok' => $gaji,
                        'jatah_cuti' => $cuti,
                        'tanggal_masuk' => $tglMasuk,
                        'status_karyawan' => $statusKaryawan,
                        'tanggal_berakhir_kontrak' => ($statusKaryawan === 'tetap') ? null : $tglSelesai,
                    ]);
                } else {
                    // Create new
                    // Check if email already used by another user
                    if (User::where('email', $email)->exists()) {
                        throw new \Exception("Email $email sudah terdaftar untuk karyawan lain.");
                    }

                    $newUser = User::create([
                        'perusahaan_id' => $perusahaan_id,
                        'name' => $name,
                        'email' => $email,
                        'password' => Hash::make('password123'), // Default password
                        'status_user' => 'user',
                    ]);

                    Karyawan::create([
                        'perusahaan_id' => $perusahaan_id,
                        'user_id' => $newUser->id,
                        'nik' => $nik,
                        'divisi_id' => $divisi->id,
                        'jabatan_id' => $jabatan->id,
                        'gaji_pokok' => $gaji,
                        'jatah_cuti' => $cuti,
                        'tanggal_masuk' => $tglMasuk,
                        'status_karyawan' => $statusKaryawan,
                        'tanggal_berakhir_kontrak' => ($statusKaryawan === 'tetap') ? null : $tglSelesai,
                        'is_active' => true,
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Data pegawai berhasil di-import.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal import data: ' . $e->getMessage());
        }
    }
}
