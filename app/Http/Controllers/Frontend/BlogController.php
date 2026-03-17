<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $blogs = Blog::with('comments', 'category', 'author')->where('status', 1)
            ->when($request->filled('search'), function($query) use ($request) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category'), function($query) use ($request) {
                $slug = $request->category;
                $query->whereHas('category', function($q) use ($slug) {
                    $q->where('slug', $slug);
                });
            })->paginate(10);

        return view('frontend.pages.blog', compact('blogs'));
    }

    public function show(String $slug): View
    {
        $blog = Blog::with('category')->where('slug', $slug)->where('status', 1)->firstOrFail();
        $recentBlogs = Blog::where('status', 1)->where('slug', '!=', $slug)->latest()->take(3)->get();
        $blogCategories = BlogCategory::withCount('blogs')->where('status', 1)->get();
        return view('frontend.pages.blog-detail', compact('blog', 'recentBlogs', 'blogCategories'));
    }


    public function storeComment(Request $request, String $id): RedirectResponse
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->comments()->create([
            'user_id' => user()->id,
            'blog_id' => $blog->id,
            'comment' => $request->comment,
        ]);

        notyf()->success('Comment posted successfully!');
        return to_route('blog.show', $blog->slug);
    }
}
