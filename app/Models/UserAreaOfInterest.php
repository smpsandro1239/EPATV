<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAreaOfInterest extends Model
{
    protected $fillable = ['user_id', 'area_of_interest_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function areaOfInterest()
    {
        return $this->belongsTo(AreaOfInterest::class);
    }
}
