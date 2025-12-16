<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\FeatureUpdateRequest;

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

        // Pole pro uchování cest ke starým souborům, které smažeme až na konci, když vše klapne
        $filesToDelete = [];
        // Pole pro sběr chyb obrázků
        $errors = [];

        // --- MANUÁLNÍ VALIDACE OBRÁZKU 1 (Main Image) ---
        if ($request->hasFile('image_one')) {
            $validator = Validator::make($request->all(), [
                'image_one' => 'image|max:600',
            ]);

            if ($validator->fails()) {
                $errors[] = "Main Image: " . $validator->errors()->first('image_one');
            } else {
                // Validace OK -> nahrát
                $file = $request->file('image_one');
                $data['image_one'] = $this->fileUpload($file);

                if (!empty($request->old_image_one)) {
                    $filesToDelete[] = $request->old_image_one;
                }
            }
        }

        if ($request->hasFile('image_two')) {
            $validator = Validator::make($request->all(), [
                'image_two' => 'image|max:600',
            ]);

            if ($validator->fails()) {
                $errors[] = "Main Image: " . $validator->errors()->first('image_two');
            } else {
                // Validace OK -> nahrát
                $file = $request->file('image_two');
                $data['image_two'] = $this->fileUpload($file);

                if (!empty($request->old_image_two)) {
                    $filesToDelete[] = $request->old_image_two;
                }
            }
        }

        if ($request->hasFile('image_three')) {
            $validator = Validator::make($request->all(), [
                'image_three' => 'image|max:600',
            ]);

            if ($validator->fails()) {
                $errors[] = "Main Image: " . $validator->errors()->first('image_three');
            } else {
                // Validace OK -> nahrát
                $file = $request->file('image_three');
                $data['image_three'] = $this->fileUpload($file);

                if (!empty($request->old_image_three)) {
                    $filesToDelete[] = $request->old_image_three;
                }
            }
        }

        // Bezpečné smazání starých souborů (až teď, když víme, že DB a nové soubory jsou OK)
        foreach ($filesToDelete as $oldImage) {
            $this->deleteFile($oldImage);
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
