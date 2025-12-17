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
     * Store a newly created resource in storage.
     */
    public function store(FeatureUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        // Pole pro uchování cest ke starým souborům, které smažeme až na konci, když vše klapne
        $filesToDelete = [];
        // Pole pro sběr chyb obrázků
        $errors = [];
        // Definujeme suffixy pro obrázky
        $suffixes = ['one', 'two', 'three'];

        foreach ($suffixes as $suffix) {
            $fieldName = "image_{$suffix}";
            $oldField  = "old_image_{$suffix}";

            if ($request->hasFile($fieldName)) {
                // Manuální validace pro konkrétní obrázek
                $validator = Validator::make($request->all(), [
                    $fieldName => 'image|max:600',
                ]);

                if ($validator->fails()) {
                    // Přidání chyby do pole pro pozdější vypsání přes notyf
                    $errors[] = "Image " . ucfirst($suffix) . ": " . $validator->errors()->first($fieldName);
                } else {
                    // Validace OK -> nahrát soubor
                    $file = $request->file($fieldName);
                    $validatedData[$fieldName] = $this->fileUpload($file);

                    // Pokud existuje starý obrázek, přidáme ho do fronty na smazání
                    if (!empty($request->$oldField)) {
                        $filesToDelete[] = $request->$oldField;
                    }
                }
            }
        }

        // Pokud je vše v pořádku, uložíme/aktualizujeme data
        Feature::updateOrCreate(['id' => 1], $validatedData);

        // Smazání starých souborů (pouze pokud vše proběhlo v pořádku)
        foreach ($filesToDelete as $oldImage) {
            $this->deleteFile($oldImage);
        }
        // Pokud se vyskytly nějaké chyby u obrázků, vypíšeme je a vrátíme se zpět
        if (!empty($errors)) {
            foreach ($errors as $error) {
                notyf()->error($error);
            }
        }

        notyf()->success('Feature section stored successfully.');
        
        return redirect()->back();
    }
}
