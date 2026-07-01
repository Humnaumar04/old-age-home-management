<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    // Yeh line batati hai ke in sab fields mein data bhara ja sakta hai
    protected $fillable = [
        'user_id',
        'name',
        'designation',
        'cnic',
        'phone',
        'email',
        'shift',
        'date_of_joining',
        'salary',
        'address',
        'emergency_name',
        'emergency_phone',
        'status'
    ];
}
