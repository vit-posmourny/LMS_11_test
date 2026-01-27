<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\ContactSetting;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    function index(): View
    {
        $contactCards = Contact::where('status', 1)->get();
        $contactSetting = ContactSetting::first();
        return view('frontend.pages.contact', compact('contactCards', 'contactSetting'));
    }


    function sendMail(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Here you would typically send the email using a mail service
        // For example:
        // Mail::to(config('mail.admin_email'))->send(new ContactFormMail($validatedData));

        // Redirect back with a success message
        return redirect()->route('contact.index')->with('success', 'Your message has been sent successfully!');
    }
}
