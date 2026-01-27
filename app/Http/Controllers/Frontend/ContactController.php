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
}
