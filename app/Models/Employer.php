<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = ['company_name'];

    public function jobs() :HasMany 
    {
        return $this->hasMany(Job::class, 'employer_id');
    }
    
    public function user() 
    {
        return $this->belongsTo(User::class, 'employer_id');   
    }

}
