<?php

namespace App\Http\Controllers\Admin;

use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutUsSectionUpdateRequest;
use App\Models\AboutUsSection;

class AboutUsSectionController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $about = AboutUsSection::first();
        return view('admin.sections.about-section.index', compact('about'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutUsSectionUpdateRequest $request)
    {
        $data = [
            'rounded_text' => $request->rounded_text,
            'learner_count' => $request->learner_count,
            'learner_count_text' => $request->learner_count_text,
            'title' => $request->about_title,
            'description' => $request->about_description,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'video_url' => $request->video_url,
            'rounded_text' => $request->rounded_text,

        ];

        if ($request->hasFile('image'))
        {
            if (isset($request->old_image)) {
                $this->deleteFile($request->old_image);
            }

            $file = $request->file('image');

            if ($file->isValid())
            {
                $image_url = $this->fileUpload($file);
                $data['image'] = $image_url;
            }
        }

        if ($request->hasFile('learner_image'))
        {
            if (isset($request->old_learner_image)) {
                $this->deleteFile($request->old_learner_image);
            }

            $file = $request->file('learner_image');

            if ($file->isValid())
            {
                $learner_image_url = $this->fileUpload($file);
                $data['learner_image'] = $learner_image_url;
            }
        }

        if ($request->hasFile('video_image'))
        {
            if (isset($request->old_video_image)) {
                $this->deleteFile($request->old_video_image);
            }

            $file = $request->file('video_image');

            if ($file->isValid())
            {
                $video_image_url = $this->fileUpload($file);
                $data['video_image'] = $video_image_url;
            }
        }

        AboutUsSection::updateOrCreate(['id' => 1], $data);

        notyf()->success("About Us updated successfully.");

        return redirect()->back();
    }
}
