<?php

// app/Http/Controllers/LessonController.php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        $lessons = $course->lessons;
        return view('lessons.index', ['course' => $course, 'lessons' => $lessons]);
    }

    public function create(Course $course)
    {
        return view('lessons.create', ['course' => $course]);
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $course->lessons()->create($request->all());

        return redirect()->route('courses.show', $course)->with('success', 'Lesson added successfully.');
    }

    public function show(Course $course, Lesson $lesson)
    {
        return view('lessons.show', ['course' => $course, 'lesson' => $lesson]);
    }

    public function edit(Course $course, Lesson $lesson)
    {
        return view('lessons.edit', ['course' => $course, 'lesson' => $lesson]);
    }

    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $lesson->update($request->all());

        return redirect()->route('courses.show', $course)->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('courses.show', $course)->with('success', 'Lesson deleted successfully.');
    }
}
