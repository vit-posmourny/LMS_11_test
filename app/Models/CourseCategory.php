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

    public function approvedActiveCourses()
    {
        $subCategoryIds = $this->subCategories()->pluck('id');

        return Course::query()
            ->whereIn('category_id', $subCategoryIds)
            ->where(['is_approved' => 'approved', 'status' => 'active']);
    }
}
