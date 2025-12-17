<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoSection;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Traits\FileUpload;
use Illuminate\Http\RedirectResponse;

class VideoSectionController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $video = VideoSection::first();
        return view('admin.sections.video.index', compact('video'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $filesToDelete = [];

        $validatedData = $request->validate([
            'background' => 'nullable|image|max:1500',
            'video_url' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:3000',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('background'))
        {
            $file = $request->file('background');
            $validatedData['background'] = $this->fileUpload($file);

            if (!empty($request->old_background)) {
                $filesToDelete[] = $request->old_background;
            }
        }
        //dd($filesToDelete);
        VideoSection::updateOrCreate(['id' => 1], $validatedData);

        // Bezpečné smazání starých souborů (až teď, když víme, že DB a nové soubory jsou OK)
        foreach ($filesToDelete as $oldImage) {
            $this->deleteFile($oldImage);
        }

        notyf()->success('Video Section store successfully.');
        return redirect()->back();
    }
}
