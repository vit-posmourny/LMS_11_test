<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsSection extends Model
{
    protected $fillable = [
        'rounded_text',
        'learner_count',
        'learner_count_text',
        'title',
        'description',
        'button_text',
        'button_url',
        'video_url',
        'rounded_text',
        'image',
        'learner_image',
        'video_image',
    ];
}
