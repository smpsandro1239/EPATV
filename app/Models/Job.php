<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'category_id',
        'description',
        'location',
        'salary',
        'contract_type',
        'expiration_date',
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function category()
    {
        return $this->belongsTo(AreaOfInterest::class, 'category_id');
    }
}
