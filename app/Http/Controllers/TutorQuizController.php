<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorQuizController extends Controller
{
    // Show form to create a new quiz for a course
    public function createQuiz($courseId)
    {
        return view('tutor.quiz.create', compact('courseId'));
    }

    // Store new quiz
    public function storeQuiz(Request $request, $courseId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $quiz = Quiz::create([
            'course_id' => $courseId,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('tutor.quiz.addQuestions', ['quizId' => $quiz->quiz_id]);
    }

    // Show form to add questions to a quiz
    public function addQuestions($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        return view('tutor.quiz.add_questions', compact('quiz'));
    }

    // Store questions and options
    public function storeQuestions(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);

        $request->validate([
            'questions' => 'required|array',
            'questions.*.question_text' => 'required|string',
            'questions.*.options' => 'required|array|min:2',
            'questions.*.options.*.option_text' => 'required|string',
            'questions.*.correct_option_index' => 'required|integer',
        ]);

        foreach ($request->questions as $qIndex => $qData) {
            $question = Question::create([
                'quiz_id' => $quiz->quiz_id,
                'question_text' => $qData['question_text'],
            ]);

            foreach ($qData['options'] as $oIndex => $optionData) {
                Option::create([
                    'question_id' => $question->question_id,
                    'option_text' => $optionData['option_text'],
                    'is_correct' => ($oIndex == $qData['correct_option_index']),
                ]);
            }
        }

        return redirect()->route('tutor.quiz.show', ['quizId' => $quiz->quiz_id])->with('success', 'Questions added successfully.');
    }

    // Show quiz details
    public function showQuiz($quizId)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);
        return view('tutor.quiz.show', compact('quiz'));
    }
}
