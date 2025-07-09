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
    function createChapterModal(Request $request): String {
        $courseId = $request->courseId;
        return view('frontend.instructor-dashboard.course.partials.chapter-modal', compact('courseId'))->render();
    }


    function storeChapter(Request $request, string $courseId): RedirectResponse
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $chapter = new CourseChapter();
        $chapter->title = $request->title;
        $chapter->course_id = $courseId;
        $chapter->instructor_id = Auth::user()->id;
        $chapter->order = CourseChapter::where('course_id', $courseId)->count() + 1;
        $chapter->save();

        return redirect()->back();
    }
}
