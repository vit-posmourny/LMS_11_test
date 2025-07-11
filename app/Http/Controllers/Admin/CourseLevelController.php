<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CourseLevel;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class CourseLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $levels = CourseLevel::paginate(15);
        return view('admin.course.level.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.course.level.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255|unique:course_levels',
        ]);

        $language = new CourseLevel();
        $language->name = $request->name;
        $language->slug = Str::slug($request->name);
        $language->save();

        notyf()->success('Level created');

        return to_route('admin.course-levels.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseLevel $course_level): View
    {
        //dd($course_level, compact('course_language'));
        return view('admin.course.level.edit', compact('course_level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseLevel $course_level)
    {
        //$request->validate(['name' => ['required', 'max:255', 'unique:course_languages,name,'.$course_level->id]]);
        $request->validate(['name' => ['required', 'max:255', Rule::unique('course_levels')->ignore($course_level->id)]]);

        $course_level->name = $request->name;
        $course_level->slug = Str::slug($request->name);
        $course_level->save();

        notyf()->success('Level Edited');

        return to_route('admin.course-levels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseLevel $course_level): Response
    {
         try {
            $course_level->delete();
            notyf()->success('Level Deleted');
            return response(['message' => 'delete success']);

         } catch (\Throwable $e) {
            notyf()->error("something went wrong");
            return response(["message" => "something went wrong"], 500);
         }

    }
}
