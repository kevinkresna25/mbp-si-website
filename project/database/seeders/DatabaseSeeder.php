<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create roles & permissions first
        $this->call(RoleSeeder::class);

        // 2. Create users (must exist before ContentSeeder & FinancialDataSeeder)
        $admin = User::firstOrCreate(
        ['email' => 'admin@masjidbukitpalma.or.id'],
        [
            'name' => 'Administrator',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]
        );
        $admin->assignRole('admin');

        $bendahara = User::firstOrCreate(
        ['email' => 'bendahara@masjidbukitpalma.or.id'],
        [
            'name' => 'Pak Ahmad (Bendahara)',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]
        );
        $bendahara->assignRole('bendahara');

        $takmir = User::firstOrCreate(
        ['email' => 'takmir@masjidbukitpalma.or.id'],
        [
            'name' => 'Pak Hasan (Takmir Inti)',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]
        );
        $takmir->assignRole('takmir_inti');

        $media = User::firstOrCreate(
        ['email' => 'media@masjidbukitpalma.or.id'],
        [
            'name' => 'Mas Cahyo (Media)',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]
        );
        $media->assignRole('media');

        // 3. Seed content & financial data (depends on users existing)
        $this->call([
            ContentSeeder::class ,
            SiteSettingSeeder::class ,
            FinancialDataSeeder::class ,
        ]);
    }
}
