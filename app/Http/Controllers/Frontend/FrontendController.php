<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hero;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    function index(): View
    {
        $hero = Hero::first();
        return view('frontend.pages.home.index', compact('hero'));
    }
}
