<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionAnswer extends Model
{
    protected $fillable = [
        'competition_attempt_id',
        'question_id',
        'answer_key',
        'question_number'
    ];

    public function competition_attempt()
    {
        return $this->belongsTo(CompetitionAttempt::class, 'competition_attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
