<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\StudentAnswer;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentQuizController extends Controller
{
    // Show list of quizzes for student's enrolled courses
    public function index()
    {
        $student = Auth::user();
        $courses = $student->courses()->pluck('course_id');
        $quizzes = Quiz::whereIn('course_id', $courses)->get();

        return view('student.quiz.index', compact('quizzes'));
    }

    // Show quiz questions for taking the quiz
    public function takeQuiz($quizId)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);
        return view('student.quiz.take', compact('quiz'));
    }

    // Submit quiz answers and calculate marks
    public function submitQuiz(Request $request, $quizId)
    {
        $student = Auth::user();
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);

        $request->validate([
            'answers' => 'required|array',
        ]);

        $totalQuestions = $quiz->questions->count();
        $correctAnswers = 0;

        foreach ($quiz->questions as $question) {
            $selectedOptionId = $request->answers[$question->question_id] ?? null;

            StudentAnswer::updateOrCreate(
                [
                    'student_id' => $student->user_id,
                    'question_id' => $question->question_id,
                ],
                [
                    'selected_option_id' => $selectedOptionId,
                ]
            );

            $correctOption = $question->options->where('is_correct', true)->first();
            if ($correctOption && $correctOption->option_id == $selectedOptionId) {
                $correctAnswers++;
            }
        }

        $marksObtained = $correctAnswers;

        QuizResult::updateOrCreate(
            [
                'student_id' => $student->user_id,
                'quiz_id' => $quiz->quiz_id,
            ],
            [
                'marks_obtained' => $marksObtained,
            ]
        );

        // Update gradesheet total marks for the course
        $gradesheet = $student->gradesheets()->where('course_id', $quiz->course_id)->first();
        if (!$gradesheet) {
            $gradesheet = $student->gradesheets()->create([
                'course_id' => $quiz->course_id,
                'total_marks' => 0,
            ]);
        }
        $gradesheet->total_marks += $marksObtained;
        $gradesheet->save();

        return redirect()->route('student.quiz.index')->with('success', 'Quiz submitted successfully. Your score: ' . $marksObtained . '/' . $totalQuestions);
    }
}
