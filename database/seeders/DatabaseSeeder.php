<?php


// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crea 10 utenti con ruolo studente (default)
        User::factory()->count(10)->create();

        // Crea un utente con ruolo teacher
        User::factory()->teacher()->create([
            'name' => 'Teacher User',
            'email' => 'teacher@example.com',
            'password' => bcrypt('teacher'),
        ]);

        // Crea un utente con ruolo admin
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
        ]);

        // Chiamata ad altri seeder
        $this->call([
            // Elenca qui i seeder che vuoi chiamare
            CourseSeeder::class,
            LessonSeeder::class,
            QuizSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,

            // Aggiungi altri seeder se necessario
        ]);
    }
}
