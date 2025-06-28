<?php

namespace App\Http\Controllers\Admin;

use App\Traits\FileUpload;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseSubCategoryStoreRequest;
use App\Http\Requests\Admin\CourseSubCategoryUpdateRequest;

class CourseSubCategoryController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(CourseCategory $course_category): View
    {
        $subCategories = CourseCategory::where('parent_id', $course_category->id)->get();
        return view('admin.course.category.sub-category.index', compact('course_category', 'subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CourseCategory $course_category): View
    {
        return view('admin.course.category.sub-category.create', compact('course_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseSubCategoryStoreRequest $request, CourseCategory $course_category)
    {
        $category = new CourseCategory();
        if ($request->hasFile('image'))
        {
            $imagepath = $this->fileUpload($request->file('image'));
            $category->image = $imagepath;
        }
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->parent_id = $course_category->id;
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success("Created successfully");

        return to_route('admin.sub-categories.index', $course_category->id);
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
    public function edit(CourseCategory $course_category, CourseCategory $course_sub_category)
    {
        return view('admin.course.category.sub-category.edit', compact('course_category', 'course_sub_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseSubCategoryUpdateRequest $request, CourseCategory $course_category, CourseCategory $course_sub_category)
    {
        $category = $course_sub_category;
        if ($request->hasFile('image'))
        {
            $imagepath = $this->fileUpload($request->file('image'));
            $this->deleteFile($category->image);
            $category->image = $imagepath;
        }
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->parent_id = $course_category->id;
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success("Created successfully");

        return to_route('admin.sub-categories.index', $course_category->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
