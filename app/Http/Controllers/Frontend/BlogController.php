<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::where('status', 1)->paginate(10);
        return view('frontend.pages.blog', compact('blogs'));
    }

    public function show(String $slug): View
    {
        $blog = Blog::with('category')->where('slug', $slug)->where('status', 1)->firstOrFail();
        $recentBlogs = Blog::where('status', 1)->where('slug', '!=', $slug)->latest()->take(3)->get();
        $blogCategories = BlogCategory::withCount('blogs')->where('status', 1)->get();
        return view('frontend.pages.blog-detail', compact('blog', 'recentBlogs', 'blogCategories'));
    }
}
