<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizScore;
use App\Models\Student;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }
    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_score' => 'required|integer|min:1',
        ]);

        Quiz::create([
            'name' => $request->name,
            'total_score' => $request->total_score
        ]);

        return redirect()->route('quizzes.index')->with('success', 'تمت إضافة الكويز بنجاح!');
    }

    public function deleteQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Student deleted successfully!');
    }



    public function showScores($id)
    {
        $quiz = Quiz::with('quizScores.student')->findOrFail($id);
        $students = Student::all();

        return view('quizzes.scores', compact('quiz', 'students'));
    }

    public function storeScores(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        foreach ($request->scores as $student_id => $score) {
            QuizScore::updateOrCreate(
                ['quiz_id' => $quiz->id, 'student_id' => $student_id],
                ['score' => $score]
            );
        }

        return redirect()->route('quizzes.index')->with('success', 'تم حفظ الدرجات بنجاح!');
    }
}
