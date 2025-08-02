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
        $courses = Course::where('is_approved', 'approved')->paginate(12);
        return view('frontend.pages.courses-page', compact('courses'));
    }
}
