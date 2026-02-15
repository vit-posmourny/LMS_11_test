<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Models\Review;
use App\Models\Enrollment;
use App\Models\CourseLevel;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CoursePageController extends Controller
{
    function index(Request $request): View
    {
        $courses = Course::where('is_approved', 'approved')
            ->where('status', 'active')
            ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                $searchTerm = $request->search;
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            })
            ->when($request->has('category') && $request->filled('category'), function ($query) use ($request) {
                if (is_array($request->category)) {
                    $query->whereIn('category_id', $request->category);
                } else {
                    $query->where('category_id', $request->category);
                }
            })
            ->when($request->has('level') && $request->filled('level'), function ($query) use ($request) {
                $query->whereIn('course_level_id', $request->level);
            })
            ->when($request->has('language') && $request->filled('language'), function ($query) use ($request) {
                $query->whereIn('course_language_id', $request->language);
            })
            ->when($request->has('from') && $request->has('to') && $request->filled('from') && $request->filled('to'), function ($query) use ($request) {
                $query->whereBetween('price', [$request->from, $request->to]);
            })
            ->orderBy('id', $request->filled('order') ? $request->order : 'desc')
            ->paginate(12);

        $categories = CourseCategory::where('status', 1)->whereNull('parent_id')->get();
        $levels = CourseLevel::all();
        $languages = CourseLanguage::all();

        return view('frontend.pages.courses-page', compact('courses', 'categories', 'levels', 'languages'));
    }


    function show(String $slug): View
    {
        $course = Course::with('reviews')->where('slug', $slug)
            ->where('is_approved', 'approved')
            ->where('status', 'active')
            ->firstOrFail();

        $reviews = Review::where('course_id', $course->id)
            ->where('status', 1)
            ->paginate(15);

        return view('frontend.pages.course-details-page', compact('course', 'reviews'));
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
