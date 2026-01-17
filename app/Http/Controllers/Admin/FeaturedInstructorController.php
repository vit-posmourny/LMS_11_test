<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\FeaturedInstructor;
use App\Traits\FileUpload;
use Illuminate\Contracts\Support\ValidatedData;

class FeaturedInstructorController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $instructors = User::where('role', 'instructor')->where('approve_status', 'approved')->get();
        return view('admin.sections.featured-instructor.index', compact('instructors'));
    }

    function getInstructorCourses(String $id): Response
    {
        $courses = Course::select('id', 'title')->where('instructor_id', $id)->where('is_approved', 'approved')->get();
        return response(['courses' => $courses]);
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'button_url' => 'required|string|max:255',
            'instructor_id' => 'required|exists:users,id',
            'featured_courses' => 'required|array',
         // 'courses.*' => 'required|exists:user,id',    // nemusí tu být - jen ukázka
            'instructor_image' => 'nullable|image|max:600',
        ]);

        $validatedData['featured_courses'] = json_encode($validatedData['featured_courses']);

        if ($request->hasFile('instructor_image'))
        {
            $file = $request->file('instructor_image');
            $validatedData['instructor_image'] = $this->fileUpload($file);

            if (!empty($request->old_image)) {
                $this->deleteFile($request->oldImage);
            }
        }

        FeaturedInstructor::updateOrCreate(['id' => 1], $validatedData);

        notyf()->success('Update data successfully.');

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
