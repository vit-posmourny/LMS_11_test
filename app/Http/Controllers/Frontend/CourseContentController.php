<?php

namespace App\Http\Controllers\Frontend;

use render;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CourseChapter;
use Illuminate\Http\Response;
use App\Models\CourseChapterLesson;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use PhpParser\Node\Expr\Cast\String_;

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


    function editChapterModal(String $id): String
    {
        $editMode = true;
        $chapter = CourseChapter::where(['id' => $id, 'instructor_id' => Auth::user()->id])->firstOrFail();
        return view('frontend.instructor-dashboard.course.partials.chapter-modal', compact('chapter', 'editMode'))->render();
    }


    function destroyChapterModal(String $chapterId): Response
    {
        try {
            $chapter = CourseChapter::findOrFail($chapterId);
            $chapter->delete();
            notyf()->success('Chapter Successfully Deleted.');
            return response(['message' => 'Chapter Successfully Deleted.'], 200);

        }catch (Exception $e) {
            notyf()->error("something went wrong");
            return response(["message" => "something went wrong"], 500);
        }
    }


    function updateChapterModal(Request $request, String $id)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $chapter = CourseChapter::findOrFail($id);
        $chapter->title = $request->title;
        $chapter->save();

        notyf()->success('Chapter Title Updated Successfully.');

        return redirect()->back();
    }


    function createLesson(Request $request): String
    {
        $courseId = $request->course_id;
        $chapterId = $request->chapter_id;
        return view('frontend.instructor-dashboard.course.partials.chapter-lesson-modal', compact('courseId', 'chapterId'))->render();
    }


    function storeLesson(Request $request): RedirectResponse
    {
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
        $lesson->slug = Str::slug($request->title);
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

        notyf()->success('Created Successfully.');

        return redirect()->back();
    }


    function editLesson(Request $request): String
    {
        $editMode = true;

        $courseId = $request->course_id;
        $chapterId = $request->chapter_id;
        $lessonId = $request->lesson_id;
        $lesson = CourseChapterLesson::where(['id' => $lessonId, 'chapter_id' => $chapterId, 'course_id' => $courseId, 'instructor_id' => Auth::user()->id])->first();

        return view('frontend.instructor-dashboard.course.partials.chapter-lesson-modal', compact('courseId', 'chapterId', 'lessonId', 'lesson', 'editMode'))->render();
    }


    function updateLesson(Request $request, string $id ): RedirectResponse
    {
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

        $lesson = CourseChapterLesson::findOrFail($id);

        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title);
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
        $lesson->save();

        notyf()->success('Updated Successfully.');

        return redirect()->back();
    }


    function destroyLesson(string $id): Response
    {
        try {
            $lesson = CourseChapterLesson::findOrFail($id);
            $lesson->delete();
            notyf()->success('Sub-Category Deleted');
            return response(['message' => 'Deleted Successfully.'], 200);

        }catch (Exception $e) {
            notyf()->error("something went wrong");
            return response(["message" => "something went wrong"], 500);
        }
    }


    function sortLesson(Request $request, String $chapterId)
    {
        $newOrders = $request->orderIds;
        foreach($newOrders as $key => $itemId)
        {
            $lesson = CourseChapterLesson::where(['chapter_id' => $chapterId, 'id' => $itemId])->first();
            $lesson->order = $key + 1;
            $lesson->save();
        }

        return response(['status' => 'success', 'message' => 'sort success']);
    }


    /** return Sort Chapters list */
    function sortChapter(String $courseId): String
    {
        $chapters = CourseChapter::where(['course_id' => $courseId])->orderBy('order')->get();
        return view('frontend.instructor-dashboard.course.partials.chapter-sort-modal', compact('chapters'))->render();
    }


    function updateSortChapter(Request $request, String $courseId)
    {
        $newOrders = $request->orderIds;
        foreach($newOrders as $key => $itemId)
        {
            $lesson = CourseChapter::where(['course_id' => $courseId, 'id' => $itemId])->first();
            $lesson->order = $key + 1;
            $lesson->save();
        }

        return response(['status' => 'success', 'message' => 'sort success']);
    }
}
