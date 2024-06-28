<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;
use Faker\Factory as Faker;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Otteniamo tutti gli utenti, ad esempio per assegnare un corso a uno specifico utente
        $users = User::all();

        foreach ($users as $user) {
            // Creiamo 3 corsi per ciascun utente
            for ($i = 0; $i < 3; $i++) {
                Course::create([
                    'title' => $faker->sentence(3),
                    'image' => $faker->imageUrl(),
                    'description' => $faker->paragraph(3),
                    'start_date' => $faker->date(),
                    'end_date' => $faker->date(),
                    'users_id' => $user->id,
                    'progress' => $faker->numberBetween(0, 100),
                ]);
            }
        }
    }
}
