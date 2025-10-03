<?php

namespace App\Http\Controllers\Admin;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CourseCategory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\CourseCategoryStoreRequest;
use App\Http\Requests\Admin\CourseCategoryUpdateRequest;

class CourseCategoryController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = CourseCategory::whereNull('parent_id')->paginate(13);
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

        notyf()->success("Category Created successfully");

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
     *
     * @param CourseCategoryUpdateRequest $request
     * @param CourseCategory $course_category
     * @return void
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

        notyf()->success("Category Updated successfully");

        return to_route('admin.course-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CourseCategory $course_category
     * @return Response
     */
    public function destroy(CourseCategory $course_category): Response
    {
        if (CourseCategory::where('parent_id', $course_category->id)->exists()) {
            return response(["message" => "Cannot delete a category with a subcategory"], 422);
        }
        try {
            $this->deleteFile($course_category->image);
            $course_category->delete();
            notyf()->success('Category Deleted');
            return response(['message' => 'delete success']);

        } catch (\Throwable $e) {
            notyf()->error("something went wrong");
            return response(["message" => "something went wrong"], 500);
        }
    }
}
