<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'answer_value',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function getIsCorrectAttribute()
    {
        return $this->question->question_answer_key === $this->id;
    }

    public function scopeForQuestion($query, $questionId)
    {
        return $query->where('question_id', $questionId);
    }
}