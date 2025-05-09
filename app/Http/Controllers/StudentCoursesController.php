<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class StudentCoursesController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $enrolledCourseIds = Auth::user()->courses()->pluck('courses.id')->toArray();

        return view('student.courses.index', compact('courses', 'enrolledCourseIds'));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        $user = Auth::user();
        $user->courses()->syncWithoutDetaching($request->course_ids);

        return redirect()->route('student.courses.index')->with('success', 'Enrolled in selected courses successfully.');
    }

    public function schedule()
    {
        $user = Auth::user();
        $courses = $user->courses()->with(['classes', 'quizzes'])->get();

        return view('student.schedule.index', compact('courses'));
    }

    public function myCourses()
    {
        $user = Auth::user();
        $courses = $user->courses()->get();
        return view('student.courses.my', compact('courses'));
    }
}
