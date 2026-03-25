<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaan = Perusahaan::findOrFail(Auth::user()->perusahaan_id);
        return view('admin.setting.perusahaan', compact('perusahaan'));
    }

    public function update(Request $request)
    {
        $perusahaan = Perusahaan::findOrFail(Auth::user()->perusahaan_id);

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:30',
            'no_wa' => 'nullable|string|max:30',
            'bidang_industri' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($perusahaan->logo) {
                Storage::delete('public/' . $perusahaan->logo);
            }
            $logoPath = $request->file('logo')->store('company_logos', 'public');
            $data['logo'] = $logoPath;
        }

        $perusahaan->update($data);

        return redirect()->back()->with('success', 'Informasi perusahaan berhasil diperbarui.');
    }
}
