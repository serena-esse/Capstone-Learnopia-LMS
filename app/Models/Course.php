<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'start_date', 'end_date', 'users_id', 'image'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function getProgressForUser($userId)
    {
        $totalLessons = $this->lessons->count();
        if ($totalLessons === 0) {
            return 0;
        }

        $completedLessons = UserLesson::where('user_id', $userId)
                                      ->whereIn('lesson_id', $this->lessons->pluck('id'))
                                      ->count();

        return ($completedLessons / $totalLessons) * 100;}
   
}
