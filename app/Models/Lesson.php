<?php




namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'video_url',
        'content'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function userLessons(): HasMany
    {
        return $this->hasMany(UserLesson::class);
    }
    public function files()
    {
        return $this->hasMany(File::class);
    }
}
