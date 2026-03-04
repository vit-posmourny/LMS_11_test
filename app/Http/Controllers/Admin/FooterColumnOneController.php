<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\FooterColumnOne;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Footer;
use DeepCopy\f003\Foo;
use Illuminate\Http\RedirectResponse;

class FooterColumnOneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $columnOne = FooterColumnOne::paginate(20);
        return view('admin.footer.column-one.index', compact('columnOne'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.footer.column-one.create');
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

        $columnOne = new FooterColumnOne();
        $columnOne->title = $request->title;
        $columnOne->url = $request->url;
        $columnOne->status = $request->has('status') ? 1 : 0;
        $columnOne->save();

        notyf()->success('Footer Column One created successfully.');
        return to_route('admin.footer-column-one.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $column = FooterColumnOne::findOrFail($id);
        return view('admin.footer.column-one.edit', compact('column'));
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

        $columnOne = FooterColumnOne::findOrFail($id);
        $columnOne->title = $request->title;
        $columnOne->url = $request->url;
        $columnOne->status = $request->has('status') ? 1 : 0;
        $columnOne->save();

        notyf()->success('Footer Column One updated successfully.');
        return to_route('admin.footer-column-one.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $columnOne = FooterColumnOne::findOrFail($id);
            $columnOne->delete();
            notyf()->success('Footer Column One Deleted');
            return response(['message' => 'Footer Column One Deleted'], 200);
        }
        catch (\Throwable $e) {
            return response(["message" => $e->getMessage()], 500);
        }
    }
}
