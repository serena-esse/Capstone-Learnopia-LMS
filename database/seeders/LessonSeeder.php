<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Course;
use Faker\Factory as Faker;

class LessonSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Otteniamo tutti i corsi, ad esempio per assegnare le lezioni a un corso specifico
        $courses = Course::all();

        foreach ($courses as $course) {
            // Creiamo 5 lezioni per ciascun corso
            for ($i = 0; $i < 5; $i++) {
                Lesson::create([
                    'course_id' => $course->id,
                    'video_url' => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
                    'title' => $faker->sentence(3),
                    'content' => $faker->paragraph(5),
                ]);
            }
        }
    }
}
