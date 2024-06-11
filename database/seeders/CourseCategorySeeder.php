<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Category;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a new category
        $category = Category::create(['name' => 'Programming']);

        // Create a new course
        $course = Course::create([
            'title' => 'Laravel for Beginners',
            'description' => 'Learn Laravel from scratch',
            'start_date' => '2024-06-01',
            'end_date' => '2024-06-30',
            'users_id' => 1
        ]);

        // Associate the course with the category
        $course->categories()->attach($category->id);
    }
}
