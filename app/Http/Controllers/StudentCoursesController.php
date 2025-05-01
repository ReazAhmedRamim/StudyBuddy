<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Quiz;

class StudentCoursesController extends Controller
{
    public function index()
    {
        $student = Auth::user();

        // Get courses the student is enrolled in
        $courses = $student->courses()->with(['classes', 'quizzes'])->get();

        // For each course, get quizzes (classes are eager loaded)
        foreach ($courses as $course) {
            $course->quizzes = Quiz::where('course_id', $course->course_id)->get();
        }

        return view('student.courses.index', compact('courses'));
    }

    public function schedule()
    {
        $student = Auth::user();

        $courses = $student->courses()->with(['classes', 'quizzes'])->get();

        return view('student.schedule.index', compact('courses'));
    }
}
