<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();

        // Recupera i corsi a cui l'utente è iscritto
        $query = $user->courses();

        // Se è presente una ricerca, applica il filtro
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Paginazione dei risultati
        $courses = $query->paginate(10);

        // Calcolo del progresso per ogni corso
        foreach ($courses as $course) {
            $course->progress = $this->calculateProgress($course, $user->id);
        }

        return view('dashboard', compact('courses'));
    }

    // Funzione per calcolare il progresso di un corso per un utente
    private function calculateProgress(Course $course, $userId)
    {
        $totalLessons = $course->lessons->count();
        if ($totalLessons === 0) {
            return 0;
        }

        $completedLessons = $course->lessons()
                                   ->whereHas('userLessons', function ($query) use ($userId) {
                                       $query->where('user_id', $userId);
                                   })->count();

        return ($completedLessons / $totalLessons) * 100;
    }
}
