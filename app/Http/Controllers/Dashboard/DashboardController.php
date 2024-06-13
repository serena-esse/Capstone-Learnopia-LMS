<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Recupera i corsi dell'utente autenticato
        $courses = Course::where('users_id', Auth::id())->get();
        
        // Passa i dati alla vista
        return view('dashboard', [
            'courses' => $courses
        ]);
    }
}
