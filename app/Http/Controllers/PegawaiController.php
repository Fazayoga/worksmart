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
    public function index()
    {
        $perusahaan_id = Auth::user()->perusahaan_id;

        $pegawai = Karyawan::with(['user', 'divisi', 'jabatan'])
            ->where('perusahaan_id', $perusahaan_id)
            ->get();

        $divisi = Divisi::where('perusahaan_id', $perusahaan_id)->get();
        $jabatan = Jabatan::where('perusahaan_id', $perusahaan_id)->get();
        $shift = \App\Models\Shift::where('perusahaan_id', $perusahaan_id)->where('is_active', true)->get();

        $pegawaiAktif = Karyawan::where('perusahaan_id', $perusahaan_id)->where('is_active', true)->count();
        $pegawaiNonaktif = Karyawan::where('perusahaan_id', $perusahaan_id)->where('is_active', false)->count();

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
                'tanggal_berakhir_kontrak' => $request->tanggal_berakhir_kontrak,
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
                'tanggal_berakhir_kontrak' => $request->tanggal_berakhir_kontrak,
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
            $user = $pegawai->user;

            $pegawai->delete();
            if ($user) $user->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Pegawai berhasil dihapus']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Gagal menghapus pegawai: ' . $e->getMessage()]);
        }
    }
}
