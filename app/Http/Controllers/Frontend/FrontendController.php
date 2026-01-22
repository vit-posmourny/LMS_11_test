<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hero;
use App\Models\Brand;
use App\Models\Course;
use App\Models\Feature;
use App\Models\Newsletter;
use App\Models\VideoSection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AboutUsSection;
use App\Models\CourseCategory;
use App\Models\FeaturedInstructor;
use App\Models\LatestCourseSection;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\BecomeInstructorSection;
use App\Models\Testimonial;

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
        $video = VideoSection::first();
        $brands = Brand::where('status', 1)->get();

        // Inicializace, aby view nehlásilo chybu, když data neexistují
        $selectedInstructorCourses = collect();
        $allInstructorCourses = collect();
        $featuredInstructor = FeaturedInstructor::first();
        if ($featuredInstructor) {
            $courseIds = json_decode($featuredInstructor->featured_courses) ?? [];
            $featuredCourses = Course::whereIn('id', $courseIds)->get();
        }

        $testimonials = Testimonial::all();

        return view('frontend.pages.home.index', compact('hero', 'feature', 'featuredCategories',
                    'about', 'latestCourses', 'becomeInstructor', 'video', 'brands', 'featuredInstructor',
                    'featuredCourses', 'testimonials'));
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


    function about(): View
    {
        $about = AboutUsSection::first();
        return view('frontend.pages.about', compact('about'));
    }
}
