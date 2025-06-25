<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Traits\FileUpload;
use App\Models\CourseCategory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseCategoryStoreRequest;

class CourseCategoryController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.course.category.index');
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
    public function store(CourseCategoryStoreRequest $request)
    {
        $imagepath = $this->fileUpload($request->file('image'));

        $category = new CourseCategory();
        $category->image = $imagepath;
        $category->icon_name = $request->icon_name;
        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success("Create successfully");

        return to_route('admin.course-categories.index');
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
