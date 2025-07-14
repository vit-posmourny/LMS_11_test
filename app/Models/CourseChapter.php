<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseChapter extends Model
{
    function lessons(): HasMany
    {
        return $this->hasMany(CourseChapterLesson::class, 'chapter_id', 'id');
    }
}
