<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'participant_id',
        'name',
        'email',
        'student_id',
        'date_of_birth',
        'no_wa',
        'gender'
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }
}
