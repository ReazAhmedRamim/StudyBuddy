<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class CourseService
{
    public function createCourse(array $data, $image = null): Course
    {
        if ($image) {
            $imagePath = $image->store('course_images', 'public');
            $data['course_image'] = $imagePath;
        }

        $course = Course::create([
            'course_code' => $data['course_code'],
            'class_timing' => $data['class_timing'],
            'title' => $data['title'] ?? null,
            'description' => $data['description'] ?? null,
            //'video_url' => $data['video_url'] ?? null,
            //'label' => $data['label'] ?? null,
            //'resources' => $data['resources'] ?? null,
            //'certificate' => $data['certificate'] ?? null,
            //'selling_price' => $data['selling_price'] ?? null,
            //'discount_price' => $data['discount_price'] ?? null,
            //'prerequisites' => $data['prerequisites'] ?? null,
            //'bestseller' => $data['bestseller'] ?? 'no',
            //'featured' => $data['featured'] ?? 'no',
            //'highestrated' => $data['highestrated'] ?? 'no',
            'tutor_id' => $data['tutor_id'] ?? null,
        ]);

        return $course;
    }

    public function updateCourse(array $data, $image = null, int $id): Course
    {
        $course = Course::findOrFail($id);

        if ($image) {
            // Delete old image if exists
            if ($course->course_image && Storage::disk('public')->exists($course->course_image)) {
                Storage::disk('public')->delete($course->course_image);
            }
            $imagePath = $image->store('course_images', 'public');
            $data['course_image'] = $imagePath;
        }

        $course->update([
            'course_code' => $data['course_code'],
            'class_timing' => $data['class_timing'],
            'title' => $data['title'] ?? $course->title,
            'description' => $data['description'] ?? $course->description,
            //'video_url' => $data['video_url'] ?? $course->video_url,
            //'label' => $data['label'] ?? $course->label,
            //'resources' => $data['resources'] ?? $course->resources,
            //'certificate' => $data['certificate'] ?? $course->certificate,
            //'selling_price' => $data['selling_price'] ?? $course->selling_price,
            //'discount_price' => $data['discount_price'] ?? $course->discount_price,
            //'prerequisites' => $data['prerequisites'] ?? $course->prerequisites,
            //'bestseller' => $data['bestseller'] ?? $course->bestseller,
            //'featured' => $data['featured'] ?? $course->featured,
            //'highestrated' => $data['highestrated'] ?? $course->highestrated,
            'tutor_id' => $data['tutor_id'] ?? $course->tutor_id,
        ]);

        return $course;
    }

    public function createCourseGoals(int $courseId, array $goals): void
    {
        $course = Course::findOrFail($courseId);
        $course->goals()->delete();

        foreach ($goals as $goal) {
            $course->goals()->create(['goal_name' => $goal]);
        }
    }

    public function updateCourseGoals(int $courseId, array $goals): void
    {
        $this->createCourseGoals($courseId, $goals);
    }
}
