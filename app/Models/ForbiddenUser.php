<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForbiddenUser extends Model
{
    protected $fillable = [
        'user_id',
        'expired_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }   
}