<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeaturedInstructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'button_text',
        'button_url',
        'instructor_id',
        'featured_courses',
        'instructor_image',
    ];

    function instructor(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'instructor_id');
    }
}
