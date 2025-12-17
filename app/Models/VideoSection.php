<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoSection extends Model
{
    protected $fillable = ['id', 'background', 'description', 'video_url', 'button_text', 'button_url'];
}
