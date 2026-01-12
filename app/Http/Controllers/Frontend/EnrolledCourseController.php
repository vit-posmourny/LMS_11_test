<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\WatchHistory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CourseChapterLesson;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

        $lesson_count = CourseChapterLesson::where('course_id', $course->id)->count();
        $lastWatchHistory = WatchHistory::where(['user_id' => user()->id, 'course_id' => $course->id])->orderBy('updated_at', 'desc')->first();
        $played = WatchHistory::where(['user_id' => user()->id, 'course_id' => $course->id])->pluck('lesson_id')->toArray();
        $watched = WatchHistory::where(['user_id' => user()->id, 'course_id' => $course->id, 'is_completed' => 1])->pluck('lesson_id')->toArray();
        $result = WatchHistory::where(['user_id' => user()->id, 'course_id' => $course->id, 'is_completed' => 1])->pluck('chapter_id')->toArray();
        $watched_by_Chapters = array_count_values($result);
        $watched_count = count($watched);

        return view('frontend.student-dashboard.enrolled-courses.player-index', compact('course', 'lastWatchHistory', 'played', 'watched',
                                                                                        'lesson_count', 'watched_count', 'watched_by_Chapters'));
    }


    function getLessonContent(Request $request)
    {
        $lesson = CourseChapterLesson::where([
            'course_id' => $request->course_id,
            'chapter_id' => $request->chapter_id,
            'id' => $request->lesson_id,
        ])->first();

        if (!$lesson) {
            return response()->json(['message' => 'Lesson not found'], 404);
        }

        // Extract YouTube Video ID if not present
        if (empty($lesson->video_id)) {
            $url = $lesson->url ?? $lesson->video_url ?? null;
            if ($url && preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                $lesson->video_id = $match[1];
            }
        }

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

        if (isset($watchedLesson->is_completed))
        {
            WatchHistory::withoutTimestamps(function () use ($request, $watchedLesson)
            {
                WatchHistory::updateOrCreate([
                    'user_id' => user()->id,
                    'course_id' => $request->course_id,
                    'chapter_id' => $request->chapter_id,
                    'lesson_id' => $request->lesson_id,
                ],[
                    'is_completed' => !$watchedLesson->is_completed,
                ]);
            });
            // pro info v zahlavi playeru, napr: Your Progress: 3 of 4 (75%)
            $watched_count = WatchHistory::where(['user_id' => user()->id, 'course_id' => $request->course_id, 'is_completed' => 1])->count();
            $lesson_count = CourseChapterLesson::where('course_id', $request->course_id)->count();
            $percentage = "(".number_format($watched_count/$lesson_count*100, 0, '.', '')."%)";
            // bude použito v resources\views\frontend\student-dashboard\enrolled-courses\index.blade.php na zobrazení "Download certificate" button
            $enrollments = Enrollment::where('user_id', user()->id)->where('course_id', $request->course_id)->get();

            foreach ($enrollments as $enrollment)
            {
                if($watched_count/$lesson_count === 1 && $enrollment->completed === 0)
                {
                    $enrollment->completed = 1;
                    $enrollment->save();
                }
                elseif ($watched_count/$lesson_count !== 1 && $enrollment->completed === 1)
                {
                    $enrollment->completed = 0;
                    $enrollment->save();
                }
            }

            // pro pocitadlo zhlednutych lekci na kapitolu v zahlavich akordeonu, napr: 1/2
            $lessons_by_Chapter = WatchHistory::where(['user_id' => user()->id, 'course_id' => $request->course_id, 'chapter_id' => $request->chapter_id])->pluck('lesson_id')->count();
            $result1 = WatchHistory::where(['user_id' => user()->id, 'course_id' => $request->course_id, 'is_completed' => 1])->pluck('chapter_id')->toArray();
            $result2 = array_count_values($result1);
            $watched_by_Chapters = $result2[$request->chapter_id] ?? '0';
            $watched_per_lessons_by_Chapter = $watched_by_Chapters.'/'.$lessons_by_Chapter;

            return response(['status' => 'success', 'message' => 'Updated Sucessfully.', 'watched_count' => $watched_count,
                            'lesson_count' => $lesson_count, 'percentage' => $percentage, 'watched_by_Chapters' => $watched_by_Chapters,
                            'watched_per_lessons_by_Chapter' => $watched_per_lessons_by_Chapter]);
        }
        return response(['status' => 'error', 'message' => "Lesson not yet viewed.", 'lessonId' => $request->lesson_id], 404);
    }


    function fileDownload(string $id)
    {
        $lesson = CourseChapterLesson::findOrFail($id);
        // 1. Získání cesty k souboru, jak je uložena v DB
        $fileUrl = $lesson->file_path; // např. /storage/files/6/archives/....zip

        // 2. Odebrání veřejného prefixu '/storage' (pokud tam je)
        // Cílem je získat interní cestu disku 'public', např. 'files/6/archives/....zip'
        $internalPath = str_replace('/storage', '', $fileUrl);

        // 3. Použijte metodu 'path()' na disku 'public' k získání plné lokální cesty
        $fullLocalPath = Storage::disk('public')->path($internalPath);

        // 4. Stáhněte soubor pomocí plné lokální cesty
        // Dále můžete přidat volitelný druhý argument pro název, pod kterým se soubor stáhne
        return response()->download($fullLocalPath, 'guma.zip');
    }
}
