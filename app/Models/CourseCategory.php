<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseCategory extends Model
{
    use HasFactory;

    // private $count = 1;

    function subCategories(): HasMany {
        return $this->hasMany(CourseCategory::class, 'parent_id', 'id');
    }


    public function getCourseCountAttribute(): int
    {
        $count = 0;

        foreach ($this->subCategories()->get() as $category)
        {
            $exists = Course::where('slug', $category->slug)
                ->where('is_approved', 'approved')
                ->where('status', 'active')
                ->exists();

            if ($exists) {
                $count++;
            }
        }
        return $count;
    }
}
