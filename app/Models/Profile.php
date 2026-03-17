<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    protected $casts = [
        'skills' => 'array',
        'languages' => 'array',
    ];

    public function resumeUrl(): Attribute
    {

    return Attribute::make(
            get:fn($value , $attributes) => $attributes['resume_url'] ? asset($attributes['resume_url']) : null,
    );

    }
}
