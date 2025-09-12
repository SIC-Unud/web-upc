<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionAttempt extends Model
{
    protected $fillable = [
        'participant_id',
        // 'is_simulation',
        'correct_answer',
        'correct_hots_answer',
        'wrong_answer',
        'score',
        'finish_at'
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public function competition_answers()
    {
        return $this->hasMany(CompetitionAnswer::class, 'competition_attempt_id', 'id');
    }
}
