<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'template_id',
        'status',
    ];

    public function template() {
        return $this->belongsTo(Template::class, 'template_id');
    }
}
