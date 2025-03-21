<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Staff',
            'sex' => 'male',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'staff',
        ]);

        User::create([
            'name' => 'User1',
            'sex' => 'male',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'student',
            'year_of_study' => 2,
            'major' => 'Computer Science',
            'department' => 'Engineering',
            'graduate_day' => '2026-06-15',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'User2',
            'sex' => 'female',
            'email' => 'user2@example.com',
            'password' => bcrypt('password123'),
            'role' => 'student',
            'year_of_study' => 4,
            'major' => 'Biology',
            'department' => 'Science',
            'graduate_day' => '2024-06-15',
            'status' => 'active',
        ]);
    }
}