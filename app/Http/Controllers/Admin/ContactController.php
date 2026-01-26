<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $contactCards = Contact::all();
        return view('admin.contact.index', compact('contactCards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|max:600',
            'title' => 'required|string|max:255',
            'line_one' => 'nullable|string|max:255',
            'line_two' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('icon'))
        {
            $file = $request->file('icon');
            $icon = $this->fileUpload($file);
        }

        $contact = new Contact();
        $contact->icon = $icon;
        $contact->title = $request->title;
        $contact->line_one = $request->line_one;
        $contact->line_two = $request->line_two;
        $contact->status = $request->status;
        $contact->save();

        notyf()->success('Contact stored successfully.');

        return redirect()->route('admin.contact.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('admin.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'icon' => 'nullable|image|max:600',
            'title' => 'required|string|max:255',
            'line_one' => 'nullable|string|max:255',
            'line_two' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $oldImagePath = $contact->icon;

        if ($request->hasFile('icon'))
        {
            $file = $request->file('icon');
            $icon = $this->fileUpload($file);
            $contact->icon = $icon;
        }

        $contact->title = $request->title;
        $contact->line_one = $request->line_one;
        $contact->line_two = $request->line_two;
        $contact->status = $request->status;
        $contact->save();

        if ($request->hasFile('icon') && $oldImagePath) {
            $this->deleteFile($oldImagePath);
        }

        notyf()->success('Contact updated successfully.');

        return redirect()->route('admin.contact.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        try {
            $this->deleteFile($contact->icon);
            $contact->delete();
            notyf()->success('Contact deleted successfully.');
            return response(['message' => 'Contact deleted successfully.'], 200);

        } catch (\Throwable $e) {
            notyf()->error("something went wrong");
            return response(["message" => "something went wrong"], 500);
        }
    }
}
