<?php

namespace App\Http\Controllers;

use App\Models\LokasiAbsensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LokasiAbsensiController extends Controller
{
    public function index()
    {
        $perusahaan_id = Auth::user()->perusahaan_id;
        $lokasi = LokasiAbsensi::where('perusahaan_id', $perusahaan_id)->get();
        
        // Ambil baseline setting dari record pertama jika ada
        $first = $lokasi->first();
        $settings = [
            'is_within_radius' => $first ? $first->is_within_radius : true,
            'is_selfie' => $first ? $first->is_selfie : false,
            'is_standby' => $first ? $first->is_standby : false,
        ];

        return view('admin.setting.lokasi-absensi', compact('lokasi', 'settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius_meter' => 'required|integer|min:1',
            'zona_waktu' => 'required|string|in:WIB,WITA,WIT',
        ]);

        $perusahaan_id = Auth::user()->perusahaan_id;

        // Ambil settings yang sedang aktif dari lokasi lain jika ada
        $existing = LokasiAbsensi::where('perusahaan_id', $perusahaan_id)->first();

        LokasiAbsensi::create([
            'perusahaan_id' => $perusahaan_id,
            'nama_lokasi' => $request->nama_lokasi,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius_meter' => $request->radius_meter,
            'zona_waktu' => $request->zona_waktu,
            'is_within_radius' => $existing ? $existing->is_within_radius : true,
            'is_selfie' => $existing ? $existing->is_selfie : false,
            'is_standby' => $existing ? $existing->is_standby : false,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Lokasi absensi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius_meter' => 'required|integer|min:1',
            'zona_waktu' => 'required|string|in:WIB,WITA,WIT',
        ]);

        $lokasi = LokasiAbsensi::where('perusahaan_id', Auth::user()->perusahaan_id)->findOrFail($id);
        $lokasi->update($request->only(['nama_lokasi', 'alamat', 'latitude', 'longitude', 'radius_meter', 'zona_waktu']));

        return redirect()->back()->with('success', 'Lokasi absensi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lokasi = LokasiAbsensi::where('perusahaan_id', Auth::user()->perusahaan_id)->findOrFail($id);
        $lokasi->delete();

        return redirect()->back()->with('success', 'Lokasi absensi berhasil dihapus.');
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'setting' => 'required|in:radius,selfie,standby',
            'value' => 'required|boolean',
        ]);

        $perusahaan_id = Auth::user()->perusahaan_id;
        $column = match($request->setting) {
            'radius' => 'is_within_radius',
            'selfie' => 'is_selfie',
            'standby' => 'is_standby',
        };

        LokasiAbsensi::where('perusahaan_id', $perusahaan_id)->update([$column => $request->value]);

        return response()->json(['success' => true, 'message' => 'Pengaturan berhasil diperbarui.']);
    }
}
