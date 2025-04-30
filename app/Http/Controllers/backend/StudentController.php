<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Auth::user();
        $courses = Course::all();
        $enrolledCourseIds = $student->courses()->pluck('courses.id')->toArray();

        return view('student.dashboard.index', compact('courses', 'enrolledCourseIds'));
    }

    public function enroll(Request $request)
    {
        $student = Auth::user();
        $courseId = $request->input('course_id');

        if (!$courseId) {
            return redirect()->back()->with('error', 'Invalid course selected.');
        }

        if ($student->courses()->where('course_id', $courseId)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        $student->courses()->attach($courseId);

        return redirect()->back()->with('success', 'Successfully enrolled in the course.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
