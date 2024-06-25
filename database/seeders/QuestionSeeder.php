<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Quiz;
use Faker\Factory as Faker;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Otteniamo tutti i quiz, ad esempio per assegnare le domande a un quiz specifico
        $quizzes = Quiz::all();

        foreach ($quizzes as $quiz) {
            // Creiamo 5 domande per ciascun quiz
            for ($i = 0; $i < 5; $i++) {
                $options = [
                    $faker->sentence,
                    $faker->sentence,
                    $faker->sentence,
                    $faker->sentence,
                ];

                $correctAnswerIndex = $faker->numberBetween(0, 3);

                Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => $faker->sentence,
                    'options' => json_encode($options),
                    'correct_answer' => $correctAnswerIndex,
                    // Inseriamo anche l'ID della risposta corretta, opzionalmente
                    'correct_answer_id' => null, // Si può popolare con l'ID di una risposta corretta specifica
                ]);
            }
        }
    }
}
