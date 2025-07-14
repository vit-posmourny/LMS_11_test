<?php

namespace App\Http\Controllers\Frontend;

use render;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CourseChapter;
use App\Models\CourseChapterLesson;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class CourseContentController extends Controller
{
    function createChapterModal(string $id): String {
        return view('frontend.instructor-dashboard.course.partials.chapter-modal', compact('id'))->render();
    }


    function storeChapter(Request $request, string $course): RedirectResponse
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $chapter = new CourseChapter();
        $chapter->title = $request->title;
        $chapter->course_id = $course;
        $chapter->instructor_id = Auth::user()->id;
        $chapter->order = CourseChapter::where('course_id', $course)->count() + 1;
        $chapter->save();

        return redirect()->back();
    }


    function createLesson(Request $request): string
    {
        $courseId = $request->course_id;
        $chapterId = $request->chapter_id;
        return view('frontend.instructor-dashboard.course.partials.chapter-lesson-modal', compact('courseId', 'chapterId'))->render();
    }


    function storeLesson(Request $request): RedirectResponse
    {
        //dd($request->all());
        $rules = [
            'title' => 'required|string|max:255',
            'storage' => 'required|string',
            'file_type' => 'required|in:video,audio,file,pdf,doc',
            'duration' => 'required',
            'is_preview' => 'boolean',
            'downloadable' => 'boolean',
            'description' => 'required',
        ];

        if ($request->filled('file')) {
            $rules['file'] = 'required';
        }else {
            $rules['url'] = 'required';
        }

        $request->validate($rules);

        $lesson = new CourseChapterLesson();

        $lesson->title = $request->title;
        $lesson->slug = \Str::slug($request->title);
        $lesson->storage = $request->storage;
        $lesson->file_path = $request->filled('file') ? $request->file : $request->url;
        $lesson->file_type = $request->file_type;
        $lesson->duration = $request->duration;
        $lesson->is_preview = $request->filled('is_preview') ? 1 : 0;
        $lesson->downloadable = $request->filled('downloadable') ? 1 : 0;
        $lesson->description = $request->description;
        $lesson->instructor_id = Auth::user()->id;
        $lesson->course_id = $request->course_id;
        $lesson->chapter_id = $request->chapter_id;
        $lesson->order = CourseChapterLesson::where('chapter_id', $request->chapter_id)->count() + 1;
        $lesson->save();

        return redirect()->back();
    }
}
