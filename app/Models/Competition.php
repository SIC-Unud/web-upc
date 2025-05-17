<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'degree',
        'wave_1_price',
        'wave_2_price',
        'wave_3_price',
        'is_team_competition',
        'is_cbt',
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
}
