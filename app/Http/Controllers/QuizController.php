<?php

// app/Http/Controllers/QuizController.php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Course $course)
    {
        $quizzes = $course->quizzes;
        return view('quizzes.index', ['course' => $course, 'quizzes' => $quizzes]);
    }

    public function create(Course $course)
    {
        return view('quizzes.create', ['course' => $course]);
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $course->quizzes()->create($request->all());

        return redirect()->route('courses.show', $course)->with('success', 'Quiz added successfully.');
    }

    public function show(Course $course, Quiz $quiz)
    {
        return view('quizzes.show', ['course' => $course, 'quiz' => $quiz]);
    }

    public function edit(Course $course, Quiz $quiz)
    {
        return view('quizzes.edit', ['course' => $course, 'quiz' => $quiz]);
    }

    public function update(Request $request, Course $course, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $quiz->update($request->all());

        return redirect()->route('courses.show', $course)->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Course $course, Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('courses.show', $course)->with('success', 'Quiz deleted successfully.');
    }
}
