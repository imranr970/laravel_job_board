<?php

namespace App\Models;

use App\Models\User;
use App\Models\JobApplication;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'location',
        'salary',
        'description',
        'experience',
        'category'
    ];


    public static array $experience = ['entry', 'intermediate', 'senior'];

    public static array $category = [
        'IT',
        'Finance',
        'Sales',
        'Marketing'
    ];

    public function employer() :BelongsTo
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }

    public function user() :BelongsTo 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job_applications() 
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

    public function hasUserApplied(Authenticatable|User|int $user) 
    {
        return $this->where('id', $this->id)
            ->whereHas('job_applications', fn($query) => $query->where('user_id', $user->id ?? $user))
            ->exists();
    }

    public function scopeFilter(Builder $builder, array $filters = []) : Builder | QueryBuilder
    {
        return $builder->when($filters['search'] ?? null, fn($query, $search) => 
            $query->where(fn($q) => 
                $q->where('title', 'like', '%' .  $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('employer', fn($query) => 
                        $query->where('company_name', 'like', '%' . $search . '%')
                    )
            )
        )->when($filters['min_salary'] ?? null, fn($query, $min_salary) => 
            $query->where('salary', '>=', $min_salary)
        )->when($filters['max_salary'] ?? null, fn($query, $max_salary) => 
            $query->where('salary', '<=', $max_salary)
        )->when($filters['experience'] ?? null, fn($query, $experience) => 
            $query->where('experience', strtolower($experience))
        )->when($filters['category'] ?? null, fn($query, $category) => 
            $query->where('category', strtolower($category))
        );
    }



}
