<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.form');
    Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.submit');

    Route::resource('courses', CourseController::class);
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('courses.my');

    Route::prefix('courses/{course}')->group(function () {
        // Lessons
        Route::resource('lessons', LessonController::class)->names([
            'index' => 'courses.lessons.index',
            'create' => 'courses.lessons.create',
            'store' => 'courses.lessons.store',
            'show' => 'courses.lessons.show',
            'edit' => 'courses.lessons.edit',
            'update' => 'courses.lessons.update',
            'destroy' => 'courses.lessons.destroy',
        ]);
        Route::get('/lessons/{lesson}/files/{file}', [FileController::class, 'download'])->name('courses.lessons.files.download');
        Route::get('/lessons/{lesson}/files/upload', [FileController::class, 'showUploadForm'])->name('courses.lessons.files.upload.form');
        Route::post('/lessons/{lesson}/files', [FileController::class, 'upload'])->name('courses.lessons.files.upload');

        // Quizzes
        Route::resource('quizzes', QuizController::class)->names([
            'index' => 'courses.quizzes.index',
            'create' => 'courses.quizzes.create',
            'store' => 'courses.quizzes.store',
            'show' => 'courses.quizzes.show',
            'edit' => 'courses.quizzes.edit',
            'update' => 'courses.quizzes.update',
            'destroy' => 'courses.quizzes.destroy',
        ]);
        Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('courses.quizzes.submit');
    });
});

Route::middleware(['auth', 'verified', 'role:admin,teacher'])->group(function () {
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

    Route::get('/courses/{course}/lessons/create', [LessonController::class, 'create'])->name('courses.lessons.create');
    Route::post('/courses/{course}/lessons', [LessonController::class, 'store'])->name('courses.lessons.store');
    Route::get('/courses/{course}/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('courses.lessons.edit');
    Route::put('/courses/{course}/lessons/{lesson}', [LessonController::class, 'update'])->name('courses.lessons.update');
    Route::delete('/courses/{course}/lessons/{lesson}', [LessonController::class, 'destroy'])->name('courses.lessons.destroy');

    Route::get('/courses/{course}/quizzes/create', [QuizController::class, 'create'])->name('courses.quizzes.create');
    Route::post('/courses/{course}/quizzes', [QuizController::class, 'store'])->name('courses.quizzes.store');
    Route::get('/courses/{course}/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('courses.quizzes.edit');
    Route::put('/courses/{course}/quizzes/{quiz}', [QuizController::class, 'update'])->name('courses.quizzes.update');
    Route::delete('/courses/{course}/quizzes/{quiz}', [QuizController::class, 'destroy'])->name('courses.quizzes.destroy');
});

require __DIR__.'/auth.php';
