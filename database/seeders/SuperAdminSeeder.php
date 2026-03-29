<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@worksmart.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('12345678'),
                'status_user' => 'admin',
                'status_dev' => 'superadmin',
                'status_aktif' => true,
                'perusahaan_id' => null,
            ]
        );
    }
}
