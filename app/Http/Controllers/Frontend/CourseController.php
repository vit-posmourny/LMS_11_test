<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request as FacadesRequest;
use App\Http\Requests\Frontend\CourseBasicInfoCreateRequest;

class CourseController extends Controller
{
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

        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->seo_description = $request->seo;
        $course->thumbnail = '';
        $course->demo_video_storage = $request->demo_video_storage;
        $course->demo_video_source = $request->video_path;
        $course->description = $request->desc;
        $course->discount = $request->discount;
        $course->instructor_id = Auth::guard('web')->user()->id;

        $course->save();

        return response([
            'status' => 'success',
            'message' => 'Updated successfully',
        ]);
    }
}
