<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyActivity extends Model
{
    protected $fillable = [
        'resident_id',
        'breakfast',
        'morning_walk',
        'lunch',
        'medication_taken',
        'physical_therapy',
        'dinner',
        'sleep_routine',
        'staff_notes',
        'date'
    ];

    // Resident ke saath relationship
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
