<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Models\CourseLevel;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\CourseLanguage;

class CoursePageController extends Controller
{
    function index(Request $request): View
    {
        $courses = Course::where('is_approved', 'approved')
            ->where('status', 'active')
            ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                $searchTerm = $request->search;
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            })
            ->when($request->has('category') && $request->filled('category'), function ($query) use ($request) {
                $query->whereIn('category_id', $request->category);
            })
            ->when($request->has('level') && $request->filled('level'), function ($query) use ($request) {
                $query->whereIn('course_level_id', $request->level);
            })
            ->when($request->has('language') && $request->filled('language'), function ($query) use ($request) {
                $query->whereIn('course_language_id', $request->language);
            })
            ->paginate(12);

        $categories = CourseCategory::where('status', 1)->whereNull('parent_id')->get();
        $levels = CourseLevel::all();
        $languages = CourseLanguage::all();

        return view('frontend.pages.courses-page', compact('courses', 'categories', 'levels', 'languages'));
    }


    function show(String $slug): View
    {
        $course = Course::where('slug', $slug)
            ->where('is_approved', 'approved')
            ->where('status', 'active')
            ->firstOrFail();

        return view('frontend.pages.course-details-page', compact('course'));
    }
}
