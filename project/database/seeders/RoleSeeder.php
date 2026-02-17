<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
    }
}
