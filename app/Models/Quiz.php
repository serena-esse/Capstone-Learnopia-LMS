<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['course_id', 'title'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
