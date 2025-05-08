<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class CourseService
{
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function createCourse(array $data, $image = null)
    {
        // Handle image upload
        if ($image) {
            $path = $image->store('public/course_images');
            $data['image'] = Storage::url($path);
        }

        // Convert array fields to JSON
        $data = $this->prepareArrayFields($data);

        // Ensure tutor_id is set
        $data['tutor_id'] = $data['tutor_id'] ?? auth()->id();

        return Course::create($data);
    }

    public function updateCourse(array $data, $image = null, $id)
    {
        $course = Course::findOrFail($id);

        // Handle image upload
        if ($image) {
            // Delete old image if exists
            if ($course->image) {
                $oldImagePath = str_replace('storage', 'public', $course->image);
                Storage::delete($oldImagePath);
            }

            $path = $image->store('public/course_images');
            $data['image'] = Storage::url($path);
        }

        // Convert array fields to JSON
        $data = $this->prepareArrayFields($data);

        return $this->courseRepository->updateCourse($data, $id);
    }

    protected function prepareArrayFields(array $data): array
    {
        if (isset($data['course_goals']) && is_array($data['course_goals'])) {
            $data['course_goals'] = json_encode($data['course_goals']);
        }

        if (isset($data['prerequisites']) && is_array($data['prerequisites'])) {
            $data['prerequisites'] = json_encode($data['prerequisites']);
        }

        return $data;
    }

    public function createCourseGoals($courseId, array $goals)
    {
        return $this->courseRepository->createCourseGoals($courseId, $goals);
    }

    public function updateCourseGoals($courseId, array $goals)
    {
        return $this->courseRepository->updateCourseGoals($courseId, $goals);
    }
}