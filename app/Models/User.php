<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'sex',
        'email',
        'password',
        'role',
        'year_of_study',
        'major',
        'department',
        'graduate_day',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'graduate_day' => 'date',
    ];

    public function isStaff()
    {
        return $this->role === 'staff';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
}