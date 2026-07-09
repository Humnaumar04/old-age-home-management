<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'task_name', 
        'task_date', 
        'status'
    ];

    // Relationship: Task kis volunteer (user) ko assign hua hai
    public function volunteer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
