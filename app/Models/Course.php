<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The users that belong to the course.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user');
    }

    /**
     * The lessons that belong to the course.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * The quizzes that belong to the course.
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
