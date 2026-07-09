<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'resident_id', 
        'relation'
    ];

    // Relationship: Family member ka apna user account (Name, Email ke liye)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Yeh family member kis resident ka relative hai
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
