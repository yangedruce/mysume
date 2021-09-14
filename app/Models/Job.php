<?php

namespace App\Models;

class Job extends Model
{
    public function task() {
        return $this->hasMany(JobTask::class);
    }

    public function achievement() {
        return $this->hasMany(JobAchievement::class);
    }
}
