<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CourseLanguage;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CourseLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $languages = CourseLanguage::paginate(15);
        return view('admin.course.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.course.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255|unique:course_languages',
        ]);

        $language = new CourseLanguage();
        $language->name = $request->name;
        $language->slug = Str::slug($request->name);
        $language->save();

        notyf()->success('Language created');

        return to_route('admin.course-languages.index');
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
    public function edit(CourseLanguage $course_language): View
    {
        //dd($course_language, compact('course_language'));
        return view('admin.course.language.edit', compact('course_language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseLanguage $course_language)
    {
        //$request->validate(['name' => ['required', 'max:255', 'unique:course_languages,name,'.$course_language->id]]);
        $request->validate(['name' => ['required', 'max:255', Rule::unique('course_languages')->ignore($course_language->id)]]);

        $course_language->name = $request->name;
        $course_language->slug = Str::slug($request->name);
        $course_language->save();

        notyf()->success('Language Edited');

        return to_route('admin.course-languages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseLanguage $course_language): Response
    {
        try
        {   // dá použít, pokud potřebuješ uměle vyvolat vyjímku
            // throw ValidationException::withMessages(['you have an error']);
            $course_language->delete();
            notyf()->success('Language Deleted');
            return response(['message' => 'delete success']);

        }catch (\Throwable $e) {
            notyf()->error("something went wrong");
            return response(["message" => "something went wrong"], 500);
        }
    }
}
