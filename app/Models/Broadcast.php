<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    protected $fillable = [
        'title',
        'broadcast', 
        'created_by'
    ];

    public function created_by() 
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
