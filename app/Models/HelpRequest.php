<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpRequest extends Model
{
    use HasFactory;

    // Jo columns hum database mein save karna chahte hain
    protected $fillable = [
        'user_id',
        'help_type',
        'description',
        'status',
    ];

    // Resident (User) ke sath relation banane ke liye
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
