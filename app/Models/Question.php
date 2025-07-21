<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'competition_id',
        'is_simulation',
        'question',
        'question_image',
        'question_answer_key',
        'question_score'
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }

    public function competition_answers()
    {
        return $this->hasMany(CompetitionAnswer::class, 'question_id', 'id');
    }

    public function question_answers()
    {
        return $this->hasMany(QuestionAnswer::class, 'question_id', 'id');
    }
}
