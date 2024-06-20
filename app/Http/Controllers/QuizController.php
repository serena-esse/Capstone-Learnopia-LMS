<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    /**
     * Mostra tutti i quiz associati a un corso.
     *
     * @param  Course  $course
     * @return \Illuminate\View\View
     */
    public function index(Course $course)
    {
        // Ottiene tutti i quiz associati al corso
        $quizzes = $course->quizzes()->get();
        
        // Restituisce la vista 'quizzes.index' con i dati dei quiz e del corso
        return view('quizzes.index', compact('quizzes', 'course'));
    }

    /**
     * Mostra il form per creare un nuovo quiz per un corso specifico.
     *
     * @param  Course  $course
     * @return \Illuminate\View\View
     */
    public function create(Course $course)
    {
        // Restituisce la vista 'quizzes.create' passando il corso come dato
        return view('quizzes.create', compact('course'));
    }

    /**
     * Salva un nuovo quiz nel database insieme alle domande associate.
     *
     * @param  Request  $request
     * @param  Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Course $course)
    {
        // Validazione dei dati
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.options' => 'required|array|min:2',
            'questions.*.correct_answer' => 'required|integer|min:0',
        ]);

        try {
            // Creazione di un nuovo quiz
            $quiz = new Quiz();
            $quiz->title = $validated['title'];
            $quiz->course_id = $course->id;
            $quiz->save();

            Log::info("Quiz creato con ID: " . $quiz->id);

            // Creazione delle domande associate al quiz
            foreach ($validated['questions'] as $questionData) {
                $question = new Question();
                $question->question = $questionData['question'];
                $question->options = json_encode($questionData['options']);
                $question->correct_answer = $questionData['correct_answer'];
                $question->quiz_id = $quiz->id;
                $question->save();

                Log::info("Domanda creata con ID: " . $question->id);
            }

            return redirect()->route('courses.show', $course->id)
                             ->with('success', 'Quiz created successfully.');
        } catch (\Exception $e) {
            Log::error('Errore durante la creazione del quiz: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create quiz. Please try again.']);
        }
    }


    /**
     * Mostra i dettagli di un quiz specifico, caricando anche le domande associate.
     *
     * @param  Course  $course
     * @param  Quiz  $quiz
     * @return \Illuminate\View\View
     */
    public function show(Course $course, Quiz $quiz)
    {
        // Carica tutte le domande e le risposte associate al quiz
        $quiz->load('questions.answers');
        
        // Restituisce la vista 'quizzes.show' con il quiz caricato
        return view('quizzes.show', compact('quiz'));
    }

    /**
     * Gestisce le risposte degli utenti a un quiz.
     *
     * @param  Request  $request
     * @param  Quiz  $quiz
     * @return \Illuminate\Http\RedirectResponse
     */
    public function answer(Request $request, Quiz $quiz)
    {
        // Logica per gestire le risposte degli utenti, calcolare punteggi, ecc.
        // Questa parte dipende dai requisiti specifici dell'applicazione
        
        // Reindirizza alla pagina degli indici dei quiz con un messaggio di successo
        return redirect()->route('quizzes.index', ['course' => $quiz->course_id])
                         ->with('success', 'Quiz submitted successfully.');
    }
    public function edit(Course $course, Quiz $quiz)
{
    return view('quizzes.edit', compact('course', 'quiz'));
}
public function update(Request $request, Course $course, Quiz $quiz)
{
    // Validate input
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        // Add more validation rules as needed
    ]);

    // Update the quiz using the validated data
    $quiz->update($validatedData);

    // Redirect back with success message
    return redirect()->route('courses.show', [$course->id, $quiz->id])
                     ->with('success', 'Quiz updated successfully.');
}
}
