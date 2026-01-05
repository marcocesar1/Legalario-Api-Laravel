<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => '2025',
        ];

        User::query()->createOrFirst([
            'email' => $users['email'],
        ], [
            'name' => $users['name'],
            'password' => $users['password'],
        ]);
    }
}
