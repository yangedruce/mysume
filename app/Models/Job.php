<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_id',
        'company_name',
        'title',
        'location',
        'start_month',
        'start_year',
        'end_month',
        'end_year',
        'currently_work',
    ];

    public function task() {
        return $this->hasMany(JobTask::class);
    }

    public function achievement() {
        return $this->hasMany(JobAchievement::class);
    }
}
