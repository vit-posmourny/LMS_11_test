<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseCategory extends Model
{
    use HasFactory;


    function subCategories(): HasMany {
        return $this->hasMany(CourseCategory::class, 'parent_id', 'id');
    }


    function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'category_id');
    }
}
