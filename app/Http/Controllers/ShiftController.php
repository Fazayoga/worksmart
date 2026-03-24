<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{
    public function index()
    {
        $perusahaan_id = Auth::user()->perusahaan_id;
        $shifts = Shift::with('karyawan.user')->where('perusahaan_id', $perusahaan_id)->get();
        $all_staff = Karyawan::with('user')->where('perusahaan_id', $perusahaan_id)->get();
        return view('admin.setting.jam-kerja', compact('shifts', 'all_staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_shift' => 'required|string|max:255',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'toleransi_terlambat' => 'required|integer',
            'jumlah_hari_kerja' => 'required|integer',
            'hari_kerja' => 'nullable|string',
            'hari_libur' => 'nullable|string',
            'staff_ids' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();

            $shift = Shift::create([
                'perusahaan_id' => Auth::user()->perusahaan_id,
                'nama_shift' => $request->nama_shift,
                'jam_masuk' => $request->jam_masuk,
                'jam_pulang' => $request->jam_pulang,
                'toleransi_terlambat' => $request->toleransi_terlambat,
                'jumlah_hari_kerja' => $request->jumlah_hari_kerja,
                'hari_kerja' => $request->hari_kerja,
                'hari_libur' => $request->hari_libur,
            ]);

            if ($request->has('staff_ids')) {
                Karyawan::whereIn('id', $request->staff_ids)
                    ->update(['shift_id' => $shift->id]);
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Jadwal kerja berhasil ditambahkan.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_shift' => 'required|string|max:255',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'toleransi_terlambat' => 'required|integer',
            'jumlah_hari_kerja' => 'required|integer',
            'hari_kerja' => 'nullable|string',
            'hari_libur' => 'nullable|string',
            'staff_ids' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();

            $shift = Shift::findOrFail($id);
            $shift->update([
                'nama_shift' => $request->nama_shift,
                'jam_masuk' => $request->jam_masuk,
                'jam_pulang' => $request->jam_pulang,
                'toleransi_terlambat' => $request->toleransi_terlambat,
                'jumlah_hari_kerja' => $request->jumlah_hari_kerja,
                'hari_kerja' => $request->hari_kerja,
                'hari_libur' => $request->hari_libur,
            ]);

            // Reset old assignments
            Karyawan::where('shift_id', $shift->id)->update(['shift_id' => null]);

            // Set new assignments
            if ($request->has('staff_ids')) {
                Karyawan::whereIn('id', $request->staff_ids)
                    ->update(['shift_id' => $shift->id]);
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Jadwal kerja berhasil diperbarui.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $shift = Shift::findOrFail($id);
            // Nullify shift_id for assigned employees
            Karyawan::where('shift_id', $shift->id)->update(['shift_id' => null]);
            $shift->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Jadwal kerja berhasil dihapus.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function searchStaff(Request $request)
    {
        $q = $request->q;
        $perusahaan_id = Auth::user()->perusahaan_id;

        $staff = Karyawan::with('user')
            ->where('perusahaan_id', $perusahaan_id)
            ->whereHas('user', function($query) use ($q) {
                $query->where('name', 'like', "%$q%");
            })
            ->limit(10)
            ->get();

        $results = $staff->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->user->name
            ];
        });

        return response()->json($results);
    }
}
