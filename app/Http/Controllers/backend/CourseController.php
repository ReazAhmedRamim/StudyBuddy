<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use App\Models\CourseGoal;
use App\Services\CourseService;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $tutor_id = auth()->id();
        $all_courses = Course::where('tutor_id', $tutor_id)->get();
        return view('tutor.course.index', compact('all_courses'));
    }

    public function create()
    {
        return view('tutor.course.create');
    }

    public function store(CourseRequest $request)
    {
        $validatedData = $request->validated();
        
        // Handle course creation
        $course = $this->courseService->createCourse(
            $validatedData, 
            $request->file('image')
        );

        // Handle course goals
        if (!empty($validatedData['course_goals'])) {
            $this->courseService->createCourseGoals(
                $course->id, 
                $validatedData['course_goals']
            );
        }

        return redirect()->route('tutor.course.index')
               ->with('success', 'Course created successfully!');
    }

    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        $course_goals = CourseGoal::where('course_id', $id)->get();
        return view('tutor.course.edit', compact('course', 'course_goals'));
    }

    public function update(CourseRequest $request, string $id)
    {
        $validatedData = $request->validated();

        // Update course
        $course = $this->courseService->updateCourse(
            $validatedData, 
            $request->file('image'), 
            $id
        );

        // Update course goals
        if (!empty($validatedData['course_goals'])) {
            $this->courseService->updateCourseGoals(
                $course->id, 
                $validatedData['course_goals']
            );
        }

        return redirect()->route('tutor.course.index')
               ->with('success', 'Course updated successfully!');
    }

    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        // Delete associated image
        if ($course->image) {
            $imagePath = public_path(
                parse_url($course->image, PHP_URL_PATH)
            );
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $course->delete();

        return redirect()->route('tutor.course.index')
               ->with('success', 'Course deleted successfully.');
    }
}