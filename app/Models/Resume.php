<?php

namespace App\Models;

class Resume extends Model
{
    public function template() {
        return $this->belongsTo(Template::class, 'template_id');
    }
}
