<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\CourseChapterLesson;

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

        if (!Enrollment::where('user_id', user()->id)->where('course_id', $course->id)->where('have_access', 1)->exists()) return abort(404);

        return view('frontend.student-dashboard.enrolled-courses.player-index', compact('course'));
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
        dd($request->all());
    }
}
