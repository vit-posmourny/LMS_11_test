<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CourseController extends Controller
{
    public function index(): View
    {
        return view('frontend.instructor-dashboard.course.index');
    }


    public function create(): View
    {
        return view('frontend.instructor-dashboard.course.create');
    }


    public function storeBasicInfo(Request $request)
    {
        
    }
}
