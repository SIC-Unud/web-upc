<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $fillable = [
        'question_id',
        'answer_value'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
