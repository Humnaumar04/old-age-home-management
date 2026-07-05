<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Approval;

class ApprovalSeeder extends Seeder
{
    public function run(): void
    {
        Approval::create([
            'name' => 'Ayesha Umar',
            'type' => 'Volunteer',
            'email' => 'hali@gmail.com',
            'status' => 'pending'
        ]);

        Approval::create([
            'name' => 'Kaleem Mehmood',
            'type' => 'Family',
            'email' => 'kali@gmail.com',
            'status' => 'pending'
        ]);
        Approval::create([
            'name' => 'Aftab Mehmood',
            'type' => 'Family',
            'email' => 'aftab@gmail.com',
            'status' => 'pending'
        ]);
    }
}
