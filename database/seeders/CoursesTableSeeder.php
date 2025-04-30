<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Mathematics 101',
                'description' => 'Basic concepts of algebra and geometry.',
                'instructor' => 'John Doe',
                'duration' => '3 months',
            ],
            [
                'title' => 'Physics 101',
                'description' => 'Introduction to classical mechanics.',
                'instructor' => 'Jane Smith',
                'duration' => '4 months',
            ],
            [
                'title' => 'Chemistry 101',
                'description' => 'Fundamentals of organic and inorganic chemistry.',
                'instructor' => 'Albert Johnson',
                'duration' => '3 months',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
