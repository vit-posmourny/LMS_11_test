<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\FooterColumnTwo;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Footer;
use DeepCopy\f003\Foo;
use Illuminate\Http\RedirectResponse;

class FooterColumnTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $columnTwo = FooterColumnTwo::paginate(20);
        return view('admin.footer.column-two.index', compact('columnTwo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.footer.column-two.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'status' => 'nullable|boolean',
        ]);

        $columnTwo = new FooterColumnTwo();
        $columnTwo->title = $request->title;
        $columnTwo->url = $request->url;
        $columnTwo->status = $request->has('status') ? 1 : 0;
        $columnTwo->save();

        notyf()->success('Footer Column Two created successfully.');
        return to_route('admin.footer-column-two.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $column = FooterColumnTwo::findOrFail($id);
        return view('admin.footer.column-two.edit', compact('column'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'status' => 'nullable|boolean',
        ]);

        $columnTwo = FooterColumnTwo::findOrFail($id);
        $columnTwo->title = $request->title;
        $columnTwo->url = $request->url;
        $columnTwo->status = $request->has('status') ? 1 : 0;
        $columnTwo->save();

        notyf()->success('Footer Column Two updated successfully.');
        return to_route('admin.footer-column-two.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $columnTwo = FooterColumnTwo::findOrFail($id);
            $columnTwo->delete();
            notyf()->success('Footer Column Two Deleted');
            return response(['message' => 'Footer Column Two Deleted'], 200);
        }
        catch (\Throwable $e) {
            return response(["message" => $e->getMessage()], 500);
        }
    }
}
