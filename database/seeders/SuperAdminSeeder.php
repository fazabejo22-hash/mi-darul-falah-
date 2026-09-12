<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@darulfalah.sch.id'],
            [
                'name' => 'Dr. H. Ahmad Fauzi, M.Pd.I',
                'password' => Hash::make('password123'), // Dev password
                'phone' => '081234567890',
                'is_active' => true,
            ]
        );

        $admin->assignRole('Super Admin');

        // Seed other role test accounts
        $rolesToSeed = [
            ['name' => 'Siti Aminah, S.Pd', 'email' => 'admin.tu@darulfalah.sch.id', 'role' => 'Admin/TU'],
            ['name' => 'Drs. Ach. Azhari', 'email' => 'kepala@darulfalah.sch.id', 'role' => 'Kepala Madrasah'],
            ['name' => 'Ustadz M. Zainul Arifin, S.Pd', 'email' => 'guru@darulfalah.sch.id', 'role' => 'Guru'],
            ['name' => 'Ibu Lailatul Fitri, S.Pd', 'email' => 'walikelas@darulfalah.sch.id', 'role' => 'Wali Kelas'],
            ['name' => 'Ahmad Zaky Al-Faruq', 'email' => 'siswa@darulfalah.sch.id', 'role' => 'Siswa'],
            ['name' => 'Bpk. H. Abdullah', 'email' => 'ortu@darulfalah.sch.id', 'role' => 'Orang Tua/Wali'],
        ];

        foreach ($rolesToSeed as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password123'),
                    'phone' => '081234567891',
                    'is_active' => true,
                ]
            );
            $user->assignRole($data['role']);
        }
    }
}
