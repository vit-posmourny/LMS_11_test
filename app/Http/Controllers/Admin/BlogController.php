<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Colors\Rgb\Channels\Red;

class BlogController extends Controller
{
    use \App\Traits\FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = \App\Models\BlogCategory::all();
        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:600',
            'category_id' => 'required|exists:blog_categories,id',
            'description' => 'required|string',
            'status' => 'nullable|boolean',
        ]);

        $blog = new \App\Models\Blog();

        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $blog->image = $this->fileUpload($file);
        }

        $blog->title = $request->title;
        $blog->slug = \Str::slug($request->title);
        $blog->description = $request->description;
        $blog->blog_category_id = $request->category_id;
        $blog->user_id = admin()->id;
        $blog->status = $request->status ?? 0;
        $blog->save();

        notyf()->success("Blog Created successfully");

        return to_route('admin.blogs.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
