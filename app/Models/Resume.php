<?php

namespace App\Models;

class Resume extends Model
{
    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    public function educations()
    {
        return $this->hasMany(Education::class)
            ->orderBy('start_year', 'DESC')
            ->orderBy('start_month', 'DESC');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class)
            ->orderBy('start_year', 'DESC')
            ->orderBy('start_month', 'DESC');
    }
}
