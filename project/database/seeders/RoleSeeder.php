<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $roles = [
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'takmir_inti', 'guard_name' => 'web'],
            ['name' => 'bendahara', 'guard_name' => 'web'],
            ['name' => 'media', 'guard_name' => 'web'],
            ['name' => 'jamaah', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }

        // Create permissions
        $permissions = [
            // Keuangan
            'manage transactions', 'approve transactions', 'view transactions',
            // Konten
            'manage articles', 'manage galleries', 'manage kegiatan',
            // Masjid
            'manage pembangunan', 'manage pengumuman', 'manage struktur',
            // Users
            'manage users',
            // Audit
            'view audit log',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Assign permissions to roles
        Role::findByName('admin')->givePermissionTo(Permission::all());

        Role::findByName('takmir_inti')->givePermissionTo([
            'approve transactions', 'view transactions',
            'manage articles', 'manage galleries', 'manage kegiatan',
            'manage pembangunan', 'manage pengumuman', 'manage struktur',
            'view audit log',
        ]);

        Role::findByName('bendahara')->givePermissionTo([
            'manage transactions', 'view transactions',
        ]);

        Role::findByName('media')->givePermissionTo([
            'manage articles', 'manage galleries', 'manage kegiatan',
        ]);
    }
}
