<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',          // Yeh zaroori hai role base login ke liye
        'first_name',     // Naya add kiya form ke liye
        'last_name',      // Naya add kiya form ke liye
        'cnic',           // Naya add kiya form ke liye
        'address',        // Naya add kiya form ke liye
        'relative_name',  // Naya add kiya family member ke liye
        'status',         // Naya add kiya pending approval ke liye
    ];

    // User ka Resident ke sath relationship (One-to-One)
    public function resident()
    {
        return $this->hasOne(Resident::class);
    }
    public function volunteerTasks()
    {
        return $this->hasMany(VolunteerTask::class, 'user_id');
    }
    public function family()
    {
        return $this->hasOne(Family::class);
    }
    // User ka Donations ke sath relationship (One-to-Many)
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
