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
        $seedPassword = env('SEED_DEFAULT_PASSWORD', 'password123');

        // 1. Admin Account
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@care.com',
            'password' => Hash::make($seedPassword),
            'role' => 'admin',
            'status' => 'approved',
        ]);

        // 2. Staff Account
        User::create([
            'name' => 'Ayesha Khan',
            'email' => 'staff@care.com',
            'password' => Hash::make($seedPassword),
            'role' => 'staff',
            'status' => 'approved',
        ]);

        // 3. Family Account
        User::create([
            'name' => 'Zain Malik',
            'email' => 'family@care.com',
            'password' => Hash::make($seedPassword),
            'role' => 'family',
            'status' => 'approved',
        ]);
    }
}
