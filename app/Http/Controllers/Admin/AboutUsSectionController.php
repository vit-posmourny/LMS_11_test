<?php

namespace App\Http\Controllers\Admin;

use App\Traits\FileUpload;
use App\Models\AboutUsSection;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\AboutUsSectionUpdateRequest;

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

        // Pole pro uchování cest ke starým souborům, které smažeme až na konci, když vše klapne
        $filesToDelete = [];
        // Pole pro sběr chyb obrázků
        $errors = [];

        // --- MANUÁLNÍ VALIDACE OBRÁZKU 1 (Main Image) ---
        if ($request->hasFile('image')) {
            $validator = Validator::make($request->all(), [
                'image' => 'image|max:600',
            ]);

            if ($validator->fails()) {
                $errors[] = "Main Image: " . $validator->errors()->first('image');
            } else {
                // Validace OK -> nahrát
                $file = $request->file('image');
                $data['image'] = $this->fileUpload($file);

                if (!empty($request->old_image)) {
                    $filesToDelete[] = $request->old_image;
                }
            }
        }

        // --- MANUÁLNÍ VALIDACE OBRÁZKU 2 (Learner Image) ---
        if ($request->hasFile('learner_image')) {
            $validator = Validator::make($request->all(), [
                'learner_image' => 'image|max:600',
            ]);

            if ($validator->fails()) {
                $errors[] = "Learner Image: " . $validator->errors()->first('learner_image');
            } else {
                $file = $request->file('learner_image');
                $data['learner_image'] = $this->fileUpload($file);

                if (!empty($request->old_learner_image)) {
                    $filesToDelete[] = $request->old_learner_image;
                }
            }
        }

        // --- MANUÁLNÍ VALIDACE OBRÁZKU 3 (Video Image) ---
        if ($request->hasFile('video_image')) {
            $validator = Validator::make($request->all(), [
                'video_image' => 'image|max:600',
            ]);

            if ($validator->fails()) {
                $errors[] = "Video Image: " . $validator->errors()->first('video_image');
            } else {
                $file = $request->file('video_image');
                $data['video_image'] = $this->fileUpload($file);
                
                if (!empty($request->old_video_image)) {
                    $filesToDelete[] = $request->old_video_image;
                }
            }
        }

        AboutUsSection::updateOrCreate(['id' => 1], $data);

        // Bezpečné smazání starých souborů (až teď, když víme, že DB a nové soubory jsou OK)
        foreach ($filesToDelete as $oldImage) {
            $this->deleteFile($oldImage);
        }

        // 4. Výpis zpráv uživateli
        if (count($errors) > 0) {
            // Něco se uložilo, ale obrázky měly chyby
            notyf()->success("Input text fields updated. Some images was wrong.");
            foreach($errors as $error) {
                notyf()->error($error); // Vypíše chybu pro každý vadný obrázek
            }
        } else {
            // Vše proběhlo hladce
            notyf()->success("About Us updated successfully.");
        }

        return redirect()->back();
    }
}
