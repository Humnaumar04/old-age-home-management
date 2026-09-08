<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'gender',
        'room_number',
        'date_of_admission',
        'medical_condition',
        'bp_systolic',
        'bp_diastolic',
        'doctor_name',
        'sugar_level',
        'emergency_contact_name',
        'emergency_contact_phone',
        'family_user_id', // <-- Yeh add kar diya gaya hai
        'user_id'          // <-- Yeh bhi add kar diya gaya hai
    ];

    public function dailyActivities()
    {
        return $this->hasMany(DailyActivity::class);
    }
}
