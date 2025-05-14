<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\CourseGoal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
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

    public function edit($id)
    {
        $course = Course::with('goals')->findOrFail($id);

        if ($course->tutor_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('tutor.course.edit', [
            'course' => $course,
            'course_goals' => $course->goals,
        ]);
    }

    public function update(Request $request, $id)
    {
        $course = Course::with('goals')->findOrFail($id);

        if ($course->tutor_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $data = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_name_slug' => 'required|string|max:255',
            'course_title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'resources' => 'nullable|numeric',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'label' => 'nullable|string',
            'certificate' => 'nullable|string',
            'selling_price' => 'nullable|numeric',
            'discount_price' => 'nullable|numeric',
            'prerequisites' => 'nullable|string',
            'course_goals' => 'nullable|array',
            'course_goals.*' => 'nullable|string|max:255',
        ]);

        // Upload image if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('course_images', 'public');
            $data['image'] = '/storage/' . $imagePath;
        } else {
            unset($data['image']);
        }

        $course->update($data);

        // Delete existing course goals and insert new ones
        $course->goals()->delete();

        if (!empty($data['course_goals'])) {
            foreach ($data['course_goals'] as $goal) {
                if (trim($goal) !== '') {
                    $course->goals()->create([
                        'goal_name' => $goal,
                    ]);
                }
            }
        }

        return redirect()->route('tutor.course.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        if ($course->tutor_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Delete related goals
        $course->goals()->delete();

        // Delete course
        $course->delete();

        return redirect()->route('tutor.course.index')->with('success', 'Course deleted successfully.');
    }
}
