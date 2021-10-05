<?php

namespace App\Models;

class Education extends Model
{
    public function achievements()
    {
        return $this->hasMany(EducationAchievement::class);
    }

    public function resume(){
        return $this->belongsTo(Resume::class);
    }
}
