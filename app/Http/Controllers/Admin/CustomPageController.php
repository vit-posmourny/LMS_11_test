<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\CustomPage;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Colors\Rgb\Channels\Red;

class CustomPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $customPages = CustomPage::all();
        return view('admin.custom-page.index', compact('customPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.custom-page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:custom_pages',
            'description' => 'required|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'status' => 'boolean',
            'show_at_nav' => 'boolean',
        ]);

        $page = new CustomPage();
        $page->title = $request->input('title');
        $page->slug = Str::slug($request->title);
        $page->description = $request->description;
        $page->seo_title = $request->seo_title;
        $page->seo_description = $request->seo_description;
        $page->status = $request->status ?? 0;
        $page->show_at_nav = $request->show_at_nav ?? 0;
        $page->save();

        notyf()->success('Custom page created successfully.');
        return redirect()->route('admin.custom-page.index');   // nebo to_route()
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomPage $custom_page): View
    {
        return view('admin.custom-page.edit', compact('custom_page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:custom_pages,title,' . $id,
            'description' => 'required|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'status' => 'boolean',
            'show_at_nav' => 'boolean',
        ]);

        $custom_page = CustomPage::findOrFail($id);
        $custom_page->title = $request->input('title');
        $custom_page->slug = Str::slug($request->title);
        $custom_page->description = $request->description;
        $custom_page->seo_title = $request->seo_title;
        $custom_page->seo_description = $request->seo_description;
        $custom_page->status = $request->status ?? 0;
        $custom_page->show_at_nav = $request->show_at_nav ?? 0;
        $custom_page->save();

        notyf()->success('Custom page updated successfully.');
        return redirect()->route('admin.custom-page.index');   // nebo to_route()
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomPage $custom_page)
    {
        try {
            $custom_page->delete();
            notyf()->success('Custom Page Deleted');
            return response(['message' => 'Custom Page Deleted'], 200);
        }
        catch (\Throwable $e) {
            return response(["message" => $e->getMessage()], 500);
        }
    }
}
