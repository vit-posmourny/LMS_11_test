<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ContactSetting;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Traits\FileUpload;

class ContactSettingController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $contactSetting = ContactSetting::first();
        return view('admin.contact.setting.index', compact('contactSetting'));
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
        $contactSetting = ContactSetting::first();
        $oldImagePath = $contactSetting ? $contactSetting->image : null;

        $validatedData = $request->validate([
            'image' => 'nullable|image|max:600',
            'map_url' => 'nullable|url',
        ]);

        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $image = $this->fileUpload($file);
            $validatedData['image'] = $image;
        }

        ContactSetting::updateOrCreate(['id' => 1], $validatedData);

        if ($request->hasFile('image') && $oldImagePath)
        {
            if($this->deleteFile($oldImagePath)) {
                //'Old image deleted successfully.')
            }else {
                notyf()->error('Old image not found or could not be deleted.');
            }
        }

        notyf()->success('Contact setting updated successfully.');

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
