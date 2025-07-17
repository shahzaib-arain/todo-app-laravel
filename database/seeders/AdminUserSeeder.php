<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'Shahzaib@example.com'],
            [
                'name' => 'Shahzaib Sajjad',
                'password' => Hash::make('admin123'),
                'role_id' => 1,
            ]
        );
    }
}
