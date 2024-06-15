<?php

// app/Http/Controllers/Course/CourseController.php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $courses = Course::where('users_id', Auth::user()->id)->get();
        return view('courses.index', ['courses' => $courses]);
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
{
    // Validazione dei dati di input
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    try {
        // Creazione di una nuova istanza di Course
        $course = new Course();
        $course->title = $request['title'];
        $course->description = $request['description'];
        $course->start_date = $request['start_date'];
        $course->end_date = $request['end_date'];
        $course->users_id = Auth::user()->id;

        Log::info('Course data prepared for saving', [
            'title' => $course->title,
            'description' => $course->description,
            'start_date' => $course->start_date,
            'end_date' => $course->end_date,
            'users_id' => $course->users_id
        ]);

        // Verifica e salvataggio dell'immagine
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $course->image = $imageName;
            Log::info('Image uploaded successfully', ['image' => $course->image]);
        }

        // Salvataggio del corso nel database
        $course->save();
        Log::info('Course saved successfully', ['course_id' => $course->id]);

        // Redirect alla pagina dei corsi
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    } catch (\Exception $e) {
        // Log dell'errore
        Log::error('Error creating course: ' . $e->getMessage());

        // Redirect con messaggio di errore
        return redirect()->back()->withErrors(['error' => 'Failed to create course. Please try again.']);
    }
}


    public function show(Course $course)
    {
        $course->load('lessons', 'quizzes');
        return view('courses.show', ['course' => $course]);
    }

    public function edit(Course $course)
    {
        return view('courses.edit', ['course' => $course]);
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $course->title = $request['title'];
            $course->description = $request['description'];
            $course->start_date = $request['start_date'];
            $course->end_date = $request['end_date'];

            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $course->image = $imageName;
            }

            $course->save();

            return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
