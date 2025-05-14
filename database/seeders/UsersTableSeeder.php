<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Tutor (admin) user
        User::create([
            'name'                  => 'Admin Tutor',
            'email'                 => 'reazmd56@gmail.net',
            'phone'                 => '1234567890',
            'dob'                   => '1980-01-01',
            'gender'                => 'other',
            'role'             => 'admin',
            'present_address'       => '123 Main St',
            'permanent_address'     => '456 Elm St',
            'profile_photo'         => null,
            'student_id_card'       => null,
            'education_certificate' => null,
            'nid_card'              => null,
            'qualification'         => 'PhD in Education',
            'graduation_institution'=> 'State University',
            'experience'            => '10',
            'specialization'        => 'Mathematics',
            'teaching_mode'         => 'both',
            'password'              => Hash::make('reazmd56@gmail.net'),
        ]);

        // Example student user
       
    }
}
