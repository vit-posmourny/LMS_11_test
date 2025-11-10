<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Traits\FileUpload;
use App\Models\CourseLevel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Frontend\CourseBasicInfoCreateRequest;
use App\Models\CourseChapter;

class CourseController extends Controller
{
    use FileUpload;

    public function index(): View
    {
        $courses = Course::where('instructor_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.instructor-dashboard.course.index', compact('courses'));
    }


    public function create(): View
    {
        return view('frontend.instructor-dashboard.course.create');
    }


    public function storeBasicInfo(CourseBasicInfoCreateRequest $request)
    {
        $course = new Course();

        $thumbPath = $this->fileUpload($request->file('thumbnail'));
        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->seo_description = $request->seo_description;
        $course->thumbnail = $thumbPath;
        $course->demo_video_storage = $request->demo_video_storage;
        $course->demo_video_source = $request->video_path;
        $course->description = $request->description;
        $course->price = $request->price;
        $course->discount_price = $request->discount_price;
        $course->instructor_id = Auth::guard('web')->user()->id;
        $course->save();

        // save course id to session
        Session::put('course_create_id', $course->id);

        notyf()->info('Basic Info store successfully.');

        return response([
            'status' => 'success',
            'message' => 'Updated successfully.',
            'redirect' => route('instructor.courses.edit', ['id' => $course->id, 'step' => $request->next_step])
        ]);
    }


    function edit(Request $request)
    {
        switch ($request->step) {
            case '1':
                $course = Course::findOrFail($request->id);
                return view('frontend.instructor-dashboard.course.edit', compact('course'));
                break;

            case '2':
                $categories = CourseCategory::where('status', 1)->get();
                $levels = CourseLevel::all();
                $languages = CourseLanguage::all();
                $course = Course::findOrFail($request->id);
                return view('frontend.instructor-dashboard.course.more-info', compact('course', 'categories', 'levels', 'languages'));
                break;

            case '3':
                $courseId = $request->id;
                $chapters = CourseChapter::where(['course_id' => $courseId, 'instructor_id' => Auth::user()->id])->orderBy('order')->get();
                return view('frontend.instructor-dashboard.course.content', compact('courseId', 'chapters'));
                break;

            case '4':
                $course = Course::findOrFail($request->id);
                $editMode = true;
                return view('frontend.instructor-dashboard.course.finish', compact('course', 'editMode'));
                break;
        }
    }


    function update(Request $request)
    {
        switch ($request->current_step) {
            case '1':
                $rules = [
                    "title" => "required|max:255|string",
                    'seo_description' => 'nullable|max:255|string',
                    'demo_video_storage' => 'nullable|in:upload,youtube,vimeo,external-link|string',
                    'price' => 'numeric',
                    'discount_price' => 'nullable|numeric',
                    'description' => 'required',
                    'thumbnail' => 'nullable|image|max:600',
                    'video_path' => 'nullable',
                ];

                $request->validate($rules);

                $course = Course::findOrFail($request->id);

                if ($request->hasFile('thumbnail'))
                {
                    if (isset($course->thumbnail)) {
                        $this->deleteFile($course->thumbnail);
                    }

                    $file = $request->file('thumbnail');

                    if ($file->isValid()) {
                        $course->thumbnail = $this->fileUpload($file);
                    }
                }

                $course->title = $request->title;
                $course->slug = Str::slug($request->title);
                $course->seo_description = $request->seo_description;
                $course->demo_video_storage = $request->demo_video_storage;
                $course->demo_video_source = $request->filled('file') ? $request->file : $request->url;
                $course->description = $request->description;
                $course->price = $request->price;
                $course->discount_price = $request->discount_price;
                $course->instructor_id = Auth::guard('web')->user()->id;
                $course->save();

                // save course id to session
                Session::put('course_create_id', $course->id);

                return response([
                    'status' => 'success',
                    'message' => 'Updated successfully.',
                    'redirect' => route('instructor.courses.edit', ['id' => $course->id, 'step' => $request->next_step])
                ]);
                break;

            case '2':
                $request->validate([
                    'capacity' => 'nullable|numeric',
                    'duration' => 'required|numeric',
                    'qna' => 'nullable|boolean',
                    'certificate' => 'nullable|boolean',
                    'category' => 'required|integer',
                    'course_level_id' => 'integer',
                    'course_language_id' => 'integer',
                ]);

                $course = Course::findOrFail($request->id);
                $course->capacity = $request->capacity;
                $course->duration = $request->duration;
                $course->qna = $request->qna ?? 1;
                $course->certificate = $request->certificate ?? 1;
                $course->category_id = $request->category;
                $course->course_level_id = $request->level;
                $course->course_language_id = $request->language;
                $course->save();

                return response([
                    'status' => 'success',
                    'message' => 'Updated successfully',
                    'redirect' => route('instructor.courses.edit', ['id' => $course->id, 'step' => $request->next_step])
                ]);
                break;

            case '3':
                return response([
                    'status' => 'success',
                    'message' => 'Updated successfully.',
                    'redirect' => route('instructor.courses.edit', ['id' => $request->id,'step' => $request->next_step])
                ]);
                break;

            case '4':
                $request->validate([
                    'message' => 'nullable|max:1000|string',
                    'status' => 'required|in:active,inactive,draft'
                ]);

                $course = Course::findOrFail($request->id);
                $course->message_for_reviewer = $request->message;
                $course->status = $request->status;
                $course->save();

                if ($request->next_step == '4') {
                    return response([
                        'status' => 'success',
                        'message' => 'Updated successfully.',
                        'redirect' => route('instructor.courses.index'),
                    ]);
                }else {
                    return response([
                        'status' => 'success',
                        'message' => 'Updated successfully.',
                        'redirect' => route('instructor.courses.edit', ['id' => $request->id,'step' => $request->next_step]),
                    ]);
                }
                break;
        }
    }
}
