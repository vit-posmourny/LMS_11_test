<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeatureUpdateRequest;
use Illuminate\Http\RedirectResponse;

class FeatureController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $feature = Feature::first();
        return view('admin.sections.feature.index', compact('feature'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeatureUpdateRequest $request): RedirectResponse
    {

        $feature = Feature::first();

        $data = [
            'title_one' =>  $request->title_one,
            'subtitle_one' =>  $request->subtitle_one,

            'title_two' =>  $request->title_two,
            'subtitle_two' =>  $request->subtitle_two,

            'title_three' =>  $request->title_three,
            'subtitle_three' =>  $request->subtitle_three,
        ];

        if ($request->hasFile('image_one'))
        {
            if (isset($feature->image_one)) {
                $this->deleteFile($feature->image_one);
            }

            $file = $request->file('image_one');

            if ($file->isValid())
            {
                $image_one = $this->fileUpload($file);
                $data['image_one'] = $image_one;
            }
        }

        if ($request->hasFile('image_two'))
        {
            if (isset($feature->image_two)) {
                $this->deleteFile($feature->image_two);
            }

            $file = $request->file('image_two');

            if ($file->isValid())
            {
                $image_two = $this->fileUpload($file);
                $data['image_two'] = $image_two;
            }
        }
        
        if ($request->hasFile('image_three'))
        {
            if (isset($feature->image_three)) {
                $this->deleteFile($feature->image_three);
            }

            $file = $request->file('image_three');

            if ($file->isValid())
            {
                $image_three = $this->fileUpload($file);
                $data['image_three'] = $image_three;
            }
        }

        Feature::updateOrCreate(['id' => 1], $data);

        notyf()->success('Data stored successfully.');

        return redirect()->back();
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
