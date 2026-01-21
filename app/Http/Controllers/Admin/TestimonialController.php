<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $testimonials = Testimonial::paginate(20);
        return view('admin.sections.testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.sections.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|numeric',
            'review' => 'required|string|max:2000',
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:600',
        ]);

        $file = $request->file('image');
        $image = $this->fileUpload($file);

        if (!empty($request->old_image)) {
            $this->deleteFile($request->old_image);
        }

        $testimonial = new Testimonial();
        $testimonial->rating = $request->rating;
        $testimonial->review = $request->review;
        $testimonial->user_name = $request->name;
        $testimonial->user_title = $request->title;
        $testimonial->user_image = $image;
        $testimonial->save();

        notyf()->success('Testimonial created successfully.');

        return redirect()->route('admin.testimonial-section.index');
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
    public function edit(Testimonial $testimonial_section): View
    {
        return  view('admin.sections.testimonial.edit', compact('testimonial_section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'rating' => 'required|numeric',
            'review' => 'required|string|max:2000',
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'image|max:600',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        if($request->has('image'))
        {
            $file = $request->file('image');
            $image = $this->fileUpload($file);
            $testimonial->user_image = $image;

            if (!empty($request->old_image)) {
                $this->deleteFile($request->old_image);
            }
        }

        $testimonial->rating = $request->rating;
        $testimonial->review = $request->review;
        $testimonial->user_name = $request->name;
        $testimonial->user_title = $request->title;
        $testimonial->save();

        notyf()->success('Testimonial updated successfully.');

        return redirect()->route('admin.testimonial-section.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial_section)
    {
        try {
            $this->deleteFile($testimonial_section->user_image);
            $testimonial_section->delete();
            notyf()->success('Testimonial deleted.');
            return response(['message' => 'delete success']);

        } catch (\Throwable $e) {
            logger("Something went wrong during testimonial deleting. >>".$e);
            notyf()->error("Something went wrong during testimonial deleting.");
            return response(["message" => "Something went wrong during testimonial deleting."], 500);
        }
    }
}
