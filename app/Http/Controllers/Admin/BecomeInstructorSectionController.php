<?php

namespace App\Http\Controllers\Admin;

use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\BecomeInstructorSection;
use Illuminate\Support\Facades\Validator;

class BecomeInstructorSectionController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $becomeInstructor = BecomeInstructorSection::first();
        return view('admin.sections.become-instructor.index', compact('becomeInstructor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'image' => 'nullable|image|max:600',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
        ]);
        // Pole pro uchování cest ke starým souborům, které smažeme až na konci, když vše klapne
        $filesToDelete = [];

        // --- MANUÁLNÍ VALIDACE OBRÁZKU 1 (Main Image) ---
        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $validateData['image'] = $this->fileUpload($file);

            if (!empty($request->old_image)) {
                $this->deleteFile($request->oldImage);
            }
        }

        BecomeInstructorSection::updateOrCreate(['id' => 1], $validateData);

        notyf()->success('Become Instructor Section store successfully.');
        return redirect()->back();
    }
}
