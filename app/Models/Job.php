<?php

namespace App\Models;

class Job extends Model
{
    public function tasks()
    {
        return $this->hasMany(JobTask::class);
    }

    public function achievements()
    {
        return $this->hasMany(JobAchievement::class);
    }
}
