<?php

namespace App\Http\Controllers\Frontend;

use render;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseChapter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
}
