<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'category',
        'quantity_needed',
        'urgency',
        'status'
    ];
}
