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
        // 1. Admin Account
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@care.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Staff Account
        User::create([
            'name' => 'Ayesha Khan',
            'email' => 'staff@care.com',
            'password' => Hash::make('password123'),
            'role' => 'staff',
        ]);

        // 3. Family Account
        User::create([
            'name' => 'Zain Malik',
            'email' => 'family@care.com',
            'password' => Hash::make('password123'),
            'role' => 'family',
        ]);
    }
}
