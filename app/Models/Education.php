<?php

namespace App\Models;

class Education extends Model
{
    public function achievement() {
        return $this->hasMany(EducationAchievement::class);
    }
}
