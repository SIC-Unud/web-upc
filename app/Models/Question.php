<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_id',
        'is_hot',
        'question',
        'question_image',
        'question_answer_key',
        'question_score',
    ];

    protected $casts = [
        'is_hot' => 'boolean',
        'question_score' => 'integer',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class);
    }

    public function correctAnswer()
    {
        return $this->belongsTo(QuestionAnswer::class, 'question_answer_key');
    }

    public function getCorrectAnswerTextAttribute()
    {
        return $this->correctAnswer?->answer_value;
    }

    public function getNotNullQuestionAttribute(): bool
    {
        return !empty($this->question_answer_key) && !empty($this->question);
    }

    public function scopeForCompetition($query, $competitionId)
    {
        return $query->where('competition_id', $competitionId);
    }

    public function getOrderedAnswersAttribute()
    {
        return $this->answers()->orderBy('id')->get();
    }
}