<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@test.com'], // Your constant admin email
            [
                'name' => 'Super Admin',
                'password' => '1234567890', // Your constant admin password
                'role' => User::ROLE_ADMIN,
                'approval_status' => User::STATUS_APPROVED,
            ]
        );
    }
}
