<?php

namespace App\Http\Controllers\Admin;

use App\Models\SocialLink;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SocialLinkController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $socialLinks = SocialLink::all();
        return view('admin.social-link.index', compact('socialLinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.social-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'icon' => 'required|image|max:600',
            'url' => 'required|url',
            'status' => 'required|boolean',
        ]);

        $socialLink = new SocialLink();

        $oldImagePath = $socialLink->icon;

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $icon = $this->fileUpload($file);
            $socialLink->icon = $icon;
        }
        $socialLinkurl = $request->url;
        $socialLink->status = $request->status;
        $socialLink->save();

        notyf()->success('Social link stored successfully.');

        return to_route('admin.social-links.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialLink $social_link): View
    {
        return view('admin.social-link.edit', compact('social_link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => 'nullable|image|max:600',
            'url' => 'required|url',
            'status' => 'required|boolean',
        ]);

        $socialLink = SocialLink::findOrFail($id);
        $oldImagePath = $socialLink->icon;

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $icon = $this->fileUpload($file);
            $this->deleteFile($oldImagePath);
            $socialLink->icon = $icon;
        }
        $socialLink->url = $request->url;
        $socialLink->status = $request->status;
        $socialLink->save();
        notyf()->success('Social link updated successfully.');

        return to_route('admin.social-links.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialLink $socialLink)
    {
        try {
            $this->deleteFile($socialLink->icon);
            $socialLink->delete();
            notyf()->success('Social Link Deleted');
            return response(['message' => 'Social Link Deleted']);

        } catch (\Throwable $e) {
            return response(["message" => $e->getMessage()], 500);
        }
    }
}
