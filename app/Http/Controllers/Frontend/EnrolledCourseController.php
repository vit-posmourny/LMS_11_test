<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\CourseChapterLesson;
use App\Models\WatchHistory;
use Illuminate\Http\Response;

class EnrolledCourseController extends Controller
{

    function index(): View
    {
        $enrollments = Enrollment::with('course')->where('user_id', user()->id)->get();
        return view('frontend.student-dashboard.enrolled-courses.index', compact('enrollments'));
    }


    function playerIndex(string $slug): View
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        if (!Enrollment::where('user_id', user()->id)->where('course_id', $course->id)->where('have_access', 1)->exists())
            return abort(404);

        $lastWatchHistory = WatchHistory::where(['user_id' => user()->id, 'course_id' => $course->id])->orderBy('updated_at', 'desc')->first();

        return view('frontend.student-dashboard.enrolled-courses.player-index', compact('course', 'lastWatchHistory'));
    }


    function getLessonContent(Request $request)
    {
        $lesson = CourseChapterLesson::where([
            'course_id' => $request->course_id,
            'chapter_id' => $request->chapter_id,
            'id' => $request->lesson_id,
        ])->first();

        return response()->json($lesson);
    }


    function updateWatchHistory(Request $request)
    {
        $watchHistory = WatchHistory::firstOrCreate([
            'user_id' => user()->id,
            'course_id' => $request->course_id,
            'chapter_id' => $request->chapter_id,
            'lesson_id' => $request->lesson_id,
        ]);

        $watchHistory->touch();
    }



    function updateLessonCompletion(Request $request): Response
    {
        dd($request->all());
    }
}
