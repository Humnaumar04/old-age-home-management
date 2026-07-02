<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    // Database table ka naam batayein
    protected $table = 'approvals';

    // Kaun kaun si fields fill ho sakti hain
    protected $fillable = [
        'name',
        'type',
        'email',
        'status',
    ];
}
