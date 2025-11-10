<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'title_one',
        'subtitle_one',
        'image_one',
        'title_two',
        'subtitle_two',
        'image_two',
        'title_three',
        'subtitle_three',
        'image_three',
    ];
}
