<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'user_id',
        'no_registration',
        'no_participant',
        'token',
        'competition_id',
        'source_of_information',
        'reason',
        'is_first_competition',
        'special_needs',
        'leader_name',
        'leader_student_id',
        'leader_date_of_birth',
        'leader_gender',
        'leader_no_wa',
        'institution',
        'institution_address',
        'institution_province',
        'institution_city',
        'parent_no_wa',
        'pass_photo',
        'student_proof',
        'twibbon_links',
        'subtotal',
        'total',
        'transaction_proof',
        'is_accepted',
        'reject_message',
        'is_rejected'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function members()
    {
        return $this->hasMany(Member::class, 'participant_id', 'id');
    }

    public function competition_attempt()
    {
        return $this->hasOne(CompetitionAttempt::class, 'participant_id', 'id');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }
}
