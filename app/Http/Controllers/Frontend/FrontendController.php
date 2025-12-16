<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hero;
use App\Models\Feature;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AboutUsSection;
use App\Models\CourseCategory;
use App\Models\LatestCourseSection;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\BecomeInstructorSection;

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
        $becomeInstructor = BecomeInstructorSection::first();
        return view('frontend.pages.home.index', compact('hero', 'feature', 'featuredCategories', 'about', 'latestCourses', 'becomeInstructor'));
    }


    function subscribe(Request $request) : Response
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        $newsletter = new Newsletter();
        $newsletter->email = $request->email;
        $newsletter->save();

        return response(['status' => 'success', 'message' => 'Successfully subscribe.']);
    }
}
