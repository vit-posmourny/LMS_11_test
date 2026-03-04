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
            'icon' => 'required|string|max:255',
            'url' => 'required|url',
            'status' => 'boolean',
        ]);

        $socialLink = new SocialLink();
        $socialLink->icon = $request->icon;
        $socialLink->url = $request->url;
        $socialLink->status = $request->status ?? 0;
        $socialLink->save();

        notyf()->success('Social link stored successfully.');

        return to_route('admin.social-links.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialLink $socialLink): View
    {
        return view('admin.social-link.edit', compact('socialLink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 'status' => 'nullable|boolean' z důvodu - tabler switch je vlastně checkbox, který
        // posílá hodnotu pouze pokud je zaškrtnutý. Proto nullable.
        $request->validate([
            'icon' => 'nullable|string|max:255',
            'url' => 'required|url',
            'status' => 'nullable|boolean',
        ]);

        $socialLink = SocialLink::findOrFail($id);
        $socialLink->icon = $request->icon;
        $socialLink->url = $request->url;
        // $request->status ?? 0; z důvodu - tabler switch je vlastně checkbox, který
        // posílá hodnotu pouze pokud je zaškrtnutý.
        $socialLink->status = $request->status ?? 0;
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
            $socialLink->delete();
            notyf()->success('Social Link Deleted');
            return response(['message' => 'Social Link Deleted']);

        } catch (\Throwable $e) {
            return response(["message" => $e->getMessage()], 500);
        }
    }
}
