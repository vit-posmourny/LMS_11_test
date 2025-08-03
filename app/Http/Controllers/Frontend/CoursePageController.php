<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class CoursePageController extends Controller
{
    function index(): View
    {
        $courses = Course::where('is_approved', 'approved')
            ->where('status', 'active')
            ->paginate(12);

        return view('frontend.pages.courses-page', compact('courses'));
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
