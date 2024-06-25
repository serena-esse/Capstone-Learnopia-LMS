<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Answer;
use Faker\Factory as Faker;

class AnswerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Creiamo 50 risposte di esempio
        for ($i = 0; $i < 50; $i++) {
            Answer::create([
                'answer' => $faker->sentence,
            ]);
        }
    }
}
