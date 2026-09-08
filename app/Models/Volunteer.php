<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'shift',
        'hours_this_month',
        'sessions_attended',
        'tasks_completed',
        'residents_helped'
    ];

    // Relationship: Har volunteer ka ek user account hota hai
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
