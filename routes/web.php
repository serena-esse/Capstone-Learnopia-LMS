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

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.submit');

Route::middleware('auth')->group(function () {
    Route::resource('courses', CourseController::class);

    // Definizione delle risorse annidate per le lezioni e i quiz
    Route::prefix('courses/{course}')->group(function () {
        // Lezioni
        Route::resource('lessons', LessonController::class)->names([
            'index' => 'courses.lessons.index',
            'create' => 'courses.lessons.create',
            'store' => 'courses.lessons.store',
            'show' => 'courses.lessons.show',
            'edit' => 'courses.lessons.edit',
            'update' => 'courses.lessons.update',
            'destroy' => 'courses.lessons.destroy',
        ]);

        // Quiz
        Route::resource('quizzes', QuizController::class)->names([
            'index' => 'courses.quizzes.index',
            'create' => 'courses.quizzes.create',
            'store' => 'courses.quizzes.store',
            'show' => 'courses.quizzes.show',
            'edit' => 'courses.quizzes.edit',
            'update' => 'courses.quizzes.update',
            'destroy' => 'courses.quizzes.destroy',
        ]);
    });
});

require __DIR__.'/auth.php';
