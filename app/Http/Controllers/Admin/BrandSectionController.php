<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Validator;

class BrandSectionController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $brands = Brand::all();
        return view('admin.sections.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.sections.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $filesToDelete = [];
        $imagesToUpload = [];
        $requestArray = $request->all();

        $validator = Validator::make($requestArray, [
            'image' => 'required|image|max:600',
        ]);
        //dd($validator);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                notyf()->error($error);
            }
        }

        $request->validate([
            'image' => 'required|image|max:600',
            'url' => 'required|url',
            'status' => 'boolean',
        ]);

        $brand = new Brand();
        $brand->url = $request->url;
        $brand->status = $request->status;

        foreach ($requestArray as $key => $value)
        {
            if (str_contains($key, 'image') && !str_contains($key, 'old_'))
            {
                $imagesToUpload[] = $key;
            }
        }

        if ($imagesToUpload)
        {
            foreach ($imagesToUpload as $image)
            $file = $request->file($image);
            $brand->$image = $this->fileUpload($file);

            foreach ($requestArray as $key => $value) {
                if (str_starts_with($key, 'old_') && !empty($value)) {
                    $filesToDelete[] = $value;
                }
            }
        }
        $brand->save();
        // Bezpečné smazání starých souborů (až teď, když víme, že DB a nové soubory jsou OK)
        foreach ($filesToDelete as $oldImage) {
            $this->deleteFile($oldImage);
        }

        notyf()->success('Brand Image uploaded successfully.');
        return redirect()->route('admin.brand-section.index');
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
