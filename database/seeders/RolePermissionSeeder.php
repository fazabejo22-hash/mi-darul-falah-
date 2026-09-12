<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'Super Admin',
            'Admin/TU',
            'Kepala Madrasah',
            'Guru',
            'Wali Kelas',
            'Siswa',
            'Orang Tua/Wali',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        $permissions = [
            'manage-system',
            'manage-users',
            'manage-school-profile',
            'manage-website',
            'manage-academic',
            'input-grades',
            'input-attendance',
            'view-reports',
            'view-own-grades',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superAdmin = Role::findByName('Super Admin');
        $superAdmin->givePermissionTo(Permission::all());
    }
}
