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
        'sugar_level',
        'emergency_contact_name',
        'emergency_contact_phone'
    ];
}
