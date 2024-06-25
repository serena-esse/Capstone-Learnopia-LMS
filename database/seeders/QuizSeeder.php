<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Course;
use Faker\Factory as Faker;

class QuizSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Otteniamo tutti i corsi, ad esempio per assegnare un quiz a un corso specifico
        $courses = Course::all();

        foreach ($courses as $course) {
            // Creiamo un quiz per ciascun corso
            Quiz::create([
                'course_id' => $course->id,
                'title' => $faker->sentence(2),
            ]);
        }
    }
}
