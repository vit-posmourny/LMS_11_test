<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hero;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\HeroStoreRequest;

class HeroController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $hero = Hero::first();
        return view('admin.sections.hero.index', compact('hero'));
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
    public function store(HeroStoreRequest $request): RedirectResponse
    {
        $hero = Hero::first();

        $data = [
            'label' => $request->label,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'video_button_text' => $request->video_button_text,
            'video_button_url' => $request->video_button_url,
            'banner_item_title' => $request->banner_item_title,
            'banner_item_subtitle' => $request->banner_item_subtitle,
            'rounded_text' => $request->rounded_text,
        ];

        if ($request->hasFile('hero_image'))
        {
            if (isset($hero->hero_image)) {
                $this->deleteFile($hero->hero_image);
            }

            $image = $this->fileUpload($request->file('hero_image'));
            $data['hero_image'] = $image;
        }

        Hero::updateOrCreate(['id' => 1], $data);

        notyf()->success('The data was stored successfully'); // Data stored successfully., Successfully stored the data.

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
