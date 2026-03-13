<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Colors\Rgb\Channels\Red;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = BlogCategory::paginate(20);
        return view('admin.blog.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.blog.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name',
            'status' => 'nullable|boolean',
        ]);

        $category = new BlogCategory();
        $category->name = $request->name;
        $category->slug = str()->slug($request->name);
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success('Category created successfully.');

        return to_route('admin.blog-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,'.$id,
            'status' => 'nullable|boolean',
        ]);

        $category = BlogCategory::findOrFail($id);
        $category->name = $request->name;
        $category->slug = str()->slug($request->name);
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success('Category updated successfully.');

        return to_route('admin.blog-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = BlogCategory::findOrFail($id);
        try {
            $category->delete();
            notyf()->success('Category Deleted');
            return response(['message' => 'Category Deleted'], 200);
        }
        catch (\Throwable $e) {
            return response(["message" => $e->getMessage()], 500);
        }
    }
}
