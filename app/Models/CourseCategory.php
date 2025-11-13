<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseCategory extends Model
{
    use HasFactory;

    function subCategories(): HasMany {
        return $this->hasMany(CourseCategory::class, 'parent_id', 'id');
    }


    // function course():


    // function courseCount()
    // {
    //     if (Course::where('is')
    //         ->where(['is_approved' => 'approved', 'status' => 'active'])) {
    //         return $this->subCategories()->count();
    //     }

    //     return 0;
    // }
}
