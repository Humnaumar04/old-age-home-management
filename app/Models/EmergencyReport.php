<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyReport extends Model
{
    protected $fillable = [
        'resident_id',
        'staff_id',
        'emergency_type',
        'severity_level',
        'incident_time',
        'description',
        'action_taken',
        'other_staff_present'
    ];
    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }
}
