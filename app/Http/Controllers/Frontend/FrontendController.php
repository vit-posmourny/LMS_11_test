<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hero;
use App\Models\Feature;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\CourseCategory;

class FrontendController extends Controller
{
    function index(): View
    {
        $hero = Hero::first();
        $feature = Feature::first();
        $featuredCategories = CourseCategory::where(['parent_id' => null, 'show_at_trending' => 1])->limit(12)->get();
        return view('frontend.pages.home.index', compact('hero', 'feature', 'featuredCategories'));
    }
}
