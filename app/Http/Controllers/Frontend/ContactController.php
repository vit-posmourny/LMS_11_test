<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Models\ContactSetting;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

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

        if (config('mail_queue.is_queue')) {
            Mail::to(config('settings.receiver_email'))->queue(new ContactMail($validatedData));
        } else {
            Mail::to(config('settings.receiver_email'))->send(new ContactMail($validatedData));
        }

        notyf()->success('Your message has been sent successfully.');

        return redirect()->back();
    }


    function storeReview(Request $request): RedirectResponse
    {

    }
}
