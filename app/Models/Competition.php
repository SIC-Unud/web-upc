<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function getParticipantCountAttribute()
    {
        return $this->participants()
            ->where('is_accepted', true)
            ->count();
    }

    public function getStartedRealParticipantsCountAttribute()
    {
        return $this->participants()
            ->whereHas('real_attempt', function ($q) {
                $q->whereNotNull('start_at');
            })
            ->count();
    }

    public function getFinishedRealParticipantsCountAttribute()
    {
        return $this->participants()
            ->whereHas('real_attempt', function ($q) {
                $q->whereNotNull('finish_at');
            })
            ->count();
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

    public function getFormattedStatusAttribute()
    {
        $now   = now();
        $start = $this->start_competition;
        $end   = $this->end_competition;

        $participant = Auth::user()->participant;
        if($this->is_simulation) {
            $hasWorked = $participant && $participant->simulation_attempt && $participant->simulation_attempt->finish_at != null;
            $hasWorking = $participant && $participant->simulation_attempt;
        } else {
            $hasWorked = $participant && $participant->real_attempt && $participant->real_attempt->finish_at != null;
            $hasWorking = $participant && $participant->real_attempt;
        }

        if ($hasWorked) {
            return 'Sudah Dikerjakan';
        } else if($hasWorking) {
            return 'Sedang Dikerjakan';
        }

        if ($now->lt($start)) {
            return diffInDaysHuman(Carbon::parse($start));
        } elseif ($now->between($start, $end)) {
            return 'Sedang Berlangsung';
        } else {
            return 'Terlewati';
        }
    }
}
