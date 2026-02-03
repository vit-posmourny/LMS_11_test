<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Review;
use App\Models\Contact;
use App\Mail\ContactMail;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\ContactSetting;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

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
        $alreadyReviewed = Review::where('user_id', user()->id)
            ->where('course_id', $request->course)
            ->exists();

        if ($alreadyReviewed) {
            notyf()->info('You have already reviewed this course.');
            return redirect()->back();
        }

        $request->validate([
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'course' => 'required|integer|exists:courses,id',
        ]);

        $checkPurchase = Enrollment::where('user_id', user()->id)
            ->where('course_id', $request->course)
            ->exists();

        if (!$checkPurchase) {
            notyf()->info('You can only review courses you have purchased.');
            return redirect()->back();
        }

        $review = new Review();
        $review->user_id = user()->id;
        $review->course_id = $request->course;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->reviewed = 1;
        $review->save();

        notyf()->success('Thank you for your review! It has been submitted successfully.');
        return redirect()->back();
    }
}
