<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Perusahaan;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\JabatanAkses;
use App\Models\Karyawan;
use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        try {
            DB::beginTransaction();

            // 1. Create Perusahaan
            $perusahaan = Perusahaan::create([
                'nama_perusahaan' => $request->company_name,
                'email' => $request->email,
                'no_telp' => $request->phone,
                'no_wa' => $request->mobile,
                'kabupaten' => $request->city,
                'status' => 'active',
                'trial_ends_at' => now()->addDays(15),
                'subscription_status' => 'trial'
            ]);

            // 2. Create Default Divisi: Administrasi
            $divisi = Divisi::create([
                'perusahaan_id' => $perusahaan->id,
                'nama_divisi' => 'Administrasi'
            ]);

            // 3. Create Default Jabatan: Administrator
            $jabatan = Jabatan::create([
                'perusahaan_id' => $perusahaan->id,
                'divisi_id' => $divisi->id,
                'nama_jabatan' => 'Administrator',
                'level' => 1
            ]);

            // 3.1. Assign All Default Permissions to Administrator
            foreach (JabatanAkses::getAvailableMenus() as $slug => $label) {
                JabatanAkses::create([
                    'jabatan_id' => $jabatan->id,
                    'menu_slug' => $slug
                ]);
            }

            // 4. Create User with Defaults
            $user = User::create([
                'perusahaan_id' => $perusahaan->id,
                'name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status_user' => 'admin',     // Default status_user = admin
                'status_dev' => 'user',      // Default status_dev = user
                'status_aktif' => true,
            ]);

            // 5. Create Karyawan entry for the user
            Karyawan::create([
                'perusahaan_id' => $perusahaan->id,
                'user_id' => $user->id,
                'divisi_id' => $divisi->id,
                'jabatan_id' => $jabatan->id,
                'nik' => 'ADMIN-' . Str::upper(Str::random(5)),
                'tanggal_masuk' => now(),
                'status_karyawan' => 'tetap',
                'is_active' => true,
            ]);
            
            // 6. Create Billing entry for Trial
            Billing::create([
                'perusahaan_id' => $perusahaan->id,
                'nomor_transaksi' => 'TRIAL-' . strtoupper(Str::random(10)),
                'tipe' => 'Free Trial (15 Hari)',
                'nominal' => 0,
                'keterangan' => 'Masa Percobaan Gratis 15 Hari',
                'nominal_total' => 0,
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addDays(15),
                'tanggal_bayar' => now(),
                'status' => 'active',
                'payment_status' => 'paid',
            ]);

            DB::commit();

            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil! Selamat datang di dashboard.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat pendaftaran: ' . $e->getMessage()]);
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'company_name' => ['required', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:30'],
            'mobile' => ['nullable', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
