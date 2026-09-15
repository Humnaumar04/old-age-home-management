<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthLog extends Model
{
    protected $fillable = [
        'resident_id',
        'bp_systolic',
        'bp_diastolic',
        'sugar_level',
        'body_temperature',
        'pulse_rate',
        'oxygen_saturation',
        'logged_by_staff_id',
    ];

    // Yeh health log kis resident ka hai
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    // Yeh log kis staff member ne create/log kiya hai
    public function staff()
    {
        return $this->belongsTo(User::class, 'logged_by_staff_id');
    }
}
