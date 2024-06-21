<?php



use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Rotte per tutti gli utenti autenticati
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.form');
    Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.submit');

    // Rotte accessibili solo agli admin e teacher per la creazione di corsi
    Route::middleware('role:admin,teacher')->group(function () {
        Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::patch('courses/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    });

    // Rotte per la gestione dei corsi, accessibili a tutti gli utenti autenticati
    Route::resource('courses', CourseController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);

    // Definizione delle risorse annidate per le lezioni e i quiz
    Route::prefix('courses/{course}')->group(function () {
        // Lezioni
        // Lezioni
        Route::get('lessons', [LessonController::class, 'index'])->name('courses.lessons.index');
        Route::get('lessons/{lesson}', [LessonController::class, 'show'])->name('courses.lessons.show');

        Route::middleware('role:admin,teacher')->group(function () {
            Route::get('lessons/create', [LessonController::class, 'create'])->name('courses.lessons.create');
            Route::post('lessons', [LessonController::class, 'store'])->name('courses.lessons.store');
            Route::get('lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('courses.lessons.edit');
            Route::patch('lessons/{lesson}', [LessonController::class, 'update'])->name('courses.lessons.update');
            Route::delete('lessons/{lesson}', [LessonController::class, 'destroy'])->name('courses.lessons.destroy');
        });

        Route::get('quizzes', [QuizController::class, 'index'])->name('courses.quizzes.index');
        Route::get('quizzes/{quiz}', [QuizController::class, 'show'])->name('courses.quizzes.show');

        Route::middleware('role:admin,teacher')->group(function () {
            Route::get('quizzes/create', [QuizController::class, 'create'])->name('courses.quizzes.create');
            Route::post('quizzes', [QuizController::class, 'store'])->name('courses.quizzes.store');
            Route::get('quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('courses.quizzes.edit');
            Route::patch('quizzes/{quiz}', [QuizController::class, 'update'])->name('courses.quizzes.update');
            Route::delete('quizzes/{quiz}', [QuizController::class, 'destroy'])->name('courses.quizzes.destroy');
        });

        // Rotta per sottomettere le risposte del quiz
        Route::post('quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('courses.quizzes.submit');
    });
});

require __DIR__.'/auth.php';
