<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::where('status', 1)->paginate(10);
        return view('frontend.pages.blog', compact('blogs'));
    }
}
