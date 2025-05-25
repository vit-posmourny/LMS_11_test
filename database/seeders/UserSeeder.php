<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'user@gmail.com',
                'password' => bcrypt('heslo'),
                'role' => 'student',
                'approve_status' => 'approved'
            ],
            [
                'name' => 'Instructor',
                'email' => 'instructor@gmail.com',
                'password' => bcrypt('heslo'),
                'role' => 'instructor',
                'approve_status' => 'pending'
            ]
        ];

        User::insert($users);
    }
}
