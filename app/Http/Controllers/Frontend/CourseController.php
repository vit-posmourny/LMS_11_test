<?php

namespace App\Http\Controllers\Frontend;

use file;
use App\Models\Course;
use App\Traits\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Frontend\CourseBasicInfoCreateRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    use FileUpload;

    public function index(): View
    {
        return view('frontend.instructor-dashboard.course.index');
    }


    public function create(): View
    {
        return view('frontend.instructor-dashboard.course.create');
    }


    public function storeBasicInfo(CourseBasicInfoCreateRequest $request)
    {
        $course = new Course();

        $thumbPath = $this->fileUpload($request->file('thumb'));
        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->seo_description = $request->seo;
        $course->thumbnail = $thumbPath;
        $course->demo_video_storage = $request->demo_video_storage;
        $course->demo_video_source = $request->video_path;
        $course->description = $request->desc;
        $course->discount = $request->discount;
        $course->instructor_id = Auth::guard('web')->user()->id;
        $course->save();

        // save course id to session
        Session::put('course_create_id', $course->id);

        return response([
            'status' => 'success',
            'message' => 'Updated successfully',
            'redirect' => route('instructor.courses.edit', ['id' => $course->id, 'step' => $request->next_step])
        ]);
    }


    function edit(Request $request)
    {
        switch ($request->step) {
            case '1':
                # code...
                break;
            case '2':
                return view('frontend.instructor-dashboard.course.more-info');
                break;
            default:
                # code...
                break;
        }
    }
}
