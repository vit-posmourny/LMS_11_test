<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hero;
use App\Models\Feature;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    function index(): View
    {
        $hero = Hero::first();
        $feature = Feature::first();
        return view('frontend.pages.home.index', compact('hero', 'feature'));
    }
}
