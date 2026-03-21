<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jabatan;
use App\Models\JabatanAkses;
use App\Models\Divisi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JabatanAksesController extends Controller
{
    public function index()
    {
        $perusahaan_id = Auth::user()->perusahaan_id;
        $jabatan = Jabatan::with('akses', 'divisi')->where('perusahaan_id', $perusahaan_id)->get();
        $divisi = Divisi::where('perusahaan_id', $perusahaan_id)->get();
        
        $menus = JabatanAkses::getAvailableMenus();

        return view('admin.setting.jabatan-akses', compact('jabatan', 'menus', 'divisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'divisi_id' => 'required|exists:divisi,id',
            'menus' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();
            
            $jabatan = Jabatan::create([
                'perusahaan_id' => Auth::user()->perusahaan_id,
                'divisi_id' => $request->divisi_id,
                'nama_jabatan' => $request->nama_jabatan,
                'level' => 1
            ]);

            if ($request->has('menus')) {
                foreach ($request->menus as $menu) {
                    JabatanAkses::create([
                        'jabatan_id' => $jabatan->id,
                        'menu_slug' => $menu
                    ]);
                }
            }
            
            DB::commit();
            return redirect()->back()->with('success', 'Jabatan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan jabatan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        // This method is now redundant but I'll keep it for bulk access update if needed, 
        // OR I can use it as the main update method.
        // Actually, the user wants "sekalian", so I'll move this logic into updateJabatan.
        return $this->updateJabatan($request, $id);
    }

    public function updateJabatan(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'divisi_id' => 'required|exists:divisi,id',
            'menus' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();
            
            $jabatan = Jabatan::findOrFail($id);
            $jabatan->update([
                'nama_jabatan' => $request->nama_jabatan,
                'divisi_id' => $request->divisi_id,
            ]);

            // Sync permissions
            JabatanAkses::where('jabatan_id', $id)->delete();
            if ($request->has('menus')) {
                foreach ($request->menus as $menu) {
                    JabatanAkses::create([
                        'jabatan_id' => $id,
                        'menu_slug' => $menu
                    ]);
                }
            }
            
            DB::commit();
            return redirect()->back()->with('success', 'Data jabatan dan hak akses berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $jabatan = Jabatan::findOrFail($id);
            
            // Cek jika masih ada karyawan yang menggunakan jabatan ini
            if ($jabatan->karyawan()->count() > 0) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus! Jabatan masih digunakan oleh pegawai.'], 400);
            }

            $jabatan->delete();
            return response()->json(['success' => true, 'message' => 'Jabatan berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus: ' . $e->getMessage()], 500);
        }
    }
}
