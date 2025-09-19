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
        $watched = WatchHistory::where(['user_id' => user()->id, 'course_id' => $course->id, 'is_completed' => 1])->pluck('lesson_id')->toArray();

        return view('frontend.student-dashboard.enrolled-courses.player-index', compact('course', 'lastWatchHistory', 'watched'));
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
        $watchedLesson = WatchHistory::where([
            'user_id' => user()->id,
            'course_id' => $request->course_id,
            'chapter_id' => $request->chapter_id,
            'lesson_id' => $request->lesson_id,
        ])->first();

        if (isset($watchedLesson->is_completed)) {
            WatchHistory::updateOrCreate([
                'user_id' => user()->id,
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                'lesson_id' => $request->lesson_id,
            ],[
                'is_completed' => $watchedLesson->is_completed == 0 ? 1 : 0,
            ]);

            return response(['status' => 'success', 'message' => 'Updated Sucessfully.']);
        }
        return response(['status' => 'error', 'message' => 'is_completed is not defined.']);
    }
}
