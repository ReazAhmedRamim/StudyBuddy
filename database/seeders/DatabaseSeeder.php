<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create regular test user
        
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_STUDENT,
            'approval_status' => User::STATUS_APPROVED,
        ]);

        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('1234567890'),
                'role' => User::ROLE_ADMIN,
                'approval_status' => User::STATUS_APPROVED,
                'email_verified_at' => now(),
                'phone' => '1234567890',
                'dob' => '1980-01-01',
                'gender' => 'male',
                'present_address' => 'Admin Address',
                'permanent_address' => 'Admin Permanent Address',
            ]
        );

        // Create additional users if needed
        // User::factory(10)->create();
    }
}
