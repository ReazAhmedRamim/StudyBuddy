<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Quiz;

class TutorCoursesController extends Controller
{
    public function index()
    {
        $tutor = Auth::user();

        // Get courses the tutor is teaching
        $courses = Course::where('instructor', $tutor->name)->with(['classes', 'quizzes'])->get();

        // For each course, get classes and quizzes
        foreach ($courses as $course) {
            $course->classes = CourseClass::where('course_id', $course->course_id)->get();
            $course->quizzes = Quiz::where('course_id', $course->course_id)->get();
        }

        return view('tutor.courses.index', compact('courses'));
    }

    public function editQuizDate(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'scheduled_date' => 'required|date',
        ]);

        $quiz->title = $request->input('title');
        $quiz->description = $request->input('description');
        $quiz->scheduled_date = $request->input('scheduled_date');
        $quiz->save();

        return redirect()->back()->with('success', 'Quiz date updated successfully.');
    }

    public function schedule()
    {
        $tutor = Auth::user();

        $courses = Course::where('instructor', $tutor->name)->with(['classes', 'quizzes'])->get();

        return view('tutor.schedule.index', compact('courses'));
    }
}
