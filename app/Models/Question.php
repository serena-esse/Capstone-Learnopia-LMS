<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['quiz_id', 'question', 'options', 'correct_answer_id'];

    protected $casts = [
        'options' => 'json', // Il campo 'options' viene convertito da/verso JSON automaticamente
    ];

    /**
     * Definizione della relazione: una domanda appartiene a un quiz.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Definizione della relazione: una domanda ha una risposta corretta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function correctAnswer()
    {
        return $this->belongsTo(Answer::class, 'correct_answer_id');
    }

    /**
     * Definizione della relazione: una domanda ha molte risposte.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
