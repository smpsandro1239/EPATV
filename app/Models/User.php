<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'course_completion_year',
        'photo',
        'cv',
        'company_name',
        'company_city',
        'company_website',
        'company_description',
        'company_logo',
        'registration_status'
    ];

    public function areasOfInterest()
    {
        return $this->belongsToMany(AreaOfInterest::class, 'user_areas_of_interest');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'company_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class);
    }
}
