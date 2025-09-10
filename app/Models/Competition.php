<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'code',
        'icon_competition',
        'degree',
        'wave_1_price',
        'wave_2_price',
        'wave_3_price',
        'is_team_competition',
        'is_cbt',
        'is_simulation',
        'duration',
        'start_competition',
        'end_competition'
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class, 'competition_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'competition_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getTotalPointsAttribute()
    {
        return $this->questions()->sum('question_score');
    }

    public function getQuestionCountAttribute()
    {
        return $this->questions()->count();
    }

    public function getIsCurrentlyActiveAttribute()
    {
        $now = now();
        return $this->start_competition <= $now && 
               $this->end_competition >= $now;
    }

    public function getStatusAttribute()
    {
        $now = now();
        
        if ($now < $this->start_competition) {
            return 'upcoming';
        } elseif ($now > $this->end_competition) {
            return 'ended';
        } else {
            return 'active';
        }
    }
}
