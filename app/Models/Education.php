<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_id',
        'school',
        'degree',
        'result',
        'start_month',
        'start_year',
        'end_month',
        'end_year',
    ];

    public function achievement() {
        return $this->hasMany(EducationAchievement::class);
    }
}
