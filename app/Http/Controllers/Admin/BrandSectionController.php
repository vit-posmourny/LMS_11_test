<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Validator;

use function Psy\debug;

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
        $request->validate([
            'image' => 'required|image|max:600',
            'url' => 'required|url',
            'status' => 'boolean',
        ]);

        $imagePath = $this->fileUpload($request->file('image'));

        $brand = new Brand();
        $brand->image = $imagePath;
        $brand->url = $request->url;
        $brand->status = $request->status;

        $brand->save();

        notyf()->success('Brand stored successfully.');
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
    public function edit(Brand $brand_section): View
    {
        $brand = $brand_section;
        return view('admin.sections.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'required|image|max:600',
            'url' => 'required|url',
            'status' => 'boolean',
        ]);

        $brand = Brand::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $this->fileUpload($request->file('image'));
            $brand->image = $imagePath;
        }
        $brand->url = $request->url;
        $brand->status = $request->status;
        $brand->save();

        if(!empty($request->old_image)) {
            $this->deleteFile($request->old_image);
        }

        notyf()->success('Brand updated successfully.');
        return redirect()->route('admin.brand-section.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand_section)
    {
        try {
            $this->deleteFile($brand_section->image);
            $brand_section->delete();
            notyf()->success('Brand Deleted');
            return response(['message' => 'delete success']);

        } catch (\Throwable $e) {
            notyf()->error("something went wrong");
            return response(["message" => "something went wrong"], 500);
        }
    }
}
