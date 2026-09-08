<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // <-- Yahan 'Eloquent' add karna hai

class VolunteerTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteer_id',
        'title',
        'time_slot',
        'status',
        'date',
    ];

    public function volunteer()
    {
        return $this->belongsTo(User::class, 'volunteer_id');
    }
}
