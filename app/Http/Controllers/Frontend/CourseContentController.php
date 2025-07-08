<?php

namespace App\Http\Controllers\Frontend;

use render;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class CourseContentController extends Controller
{
    function createChapterModal(): String {
        return view('frontend.instructor-dashboard.course.partials.chapter-modal')->render();
    }
}
