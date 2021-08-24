<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'education_id',
        'achievement_name',
    ];
}
