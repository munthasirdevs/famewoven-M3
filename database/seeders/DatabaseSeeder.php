<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Super Admin User
        User::updateOrCreate(
            ['email' => 'admin@famewoven.com'],
            [
                'name' => 'Munthasir Rahman',
                'password' => Hash::make('Famewoven2026!'),
                'role' => User::ROLE_SUPER_ADMIN,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // 2. Standard Admin User
        User::updateOrCreate(
            ['email' => 'ops@famewoven.com'],
            [
                'name' => 'Operations Manager',
                'password' => Hash::make('Famewoven2026!'),
                'role' => User::ROLE_ADMIN,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // 3. Editor User
        User::updateOrCreate(
            ['email' => 'editor@famewoven.com'],
            [
                'name' => 'Editorial Lead',
                'password' => Hash::make('Famewoven2026!'),
                'role' => User::ROLE_EDITOR,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // 4. Viewer User
        User::updateOrCreate(
            ['email' => 'viewer@famewoven.com'],
            [
                'name' => 'Analytics Viewer',
                'password' => Hash::make('Famewoven2026!'),
                'role' => User::ROLE_VIEWER,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
    }
}
