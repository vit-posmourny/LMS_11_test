<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hero;
use App\Models\Feature;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\AboutUsSection;
use App\Models\CourseCategory;
use App\Models\LatestCourseSection;

class FrontendController extends Controller
{
    function index(): View
    {
        $hero = Hero::first();
        $feature = Feature::first();
        $about = AboutUsSection::first();

        $featuredCategories = CourseCategory::withCount(['subCategories as active_course_count' => function($query) {
            $query->whereHas('courses', function($query) {
                $query->where(['is_approved' => 'approved', 'status' => 'active']);
            });
        }])->where(['parent_id' => null, 'show_at_trending' => 1])->limit(12)->get();
 
        $latestCourses = LatestCourseSection::first();
        return view('frontend.pages.home.index', compact('hero', 'feature', 'featuredCategories', 'about', 'latestCourses'));
    }
}
