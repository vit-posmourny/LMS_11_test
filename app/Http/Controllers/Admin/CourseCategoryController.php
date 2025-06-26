<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Traits\FileUpload;
use App\Models\CourseCategory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseCategoryStoreRequest;
use App\Http\Requests\Admin\CourseCategoryUpdateRequest;
use Illuminate\Http\RedirectResponse;

class CourseCategoryController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = CourseCategory::paginate(13);
        return view('admin.course.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.course.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCategoryStoreRequest $request): RedirectResponse
    {
        $imagepath = $this->fileUpload($request->file('image'));

        $category = new CourseCategory();
        $category->image = $imagepath;
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success("Created successfully");

        return to_route('admin.course-categories.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseCategory $course_category): View
    {
        return view('admin.course.category.edit', compact('course_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCategoryUpdateRequest $request, CourseCategory $course_category)
    {
        $category = $course_category;

        if ($request->hasFile('image'))
        {
            $imagepath = $this->fileUpload($request->file('image'));
            $this->deleteFile($category->image);
            $category->image = $imagepath;
        }

        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success("Updated successfully");

        return to_route('admin.course-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
