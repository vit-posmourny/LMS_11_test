<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $reviews = Review::with(['user', 'course'])->latest()->paginate(20);
        return view('admin.review.index', compact('reviews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review): RedirectResponse
    {
        $review->status = $request->status ? 1 : 0;
        $review->save();

        notyf()->success('Review status updated successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review): Response
    {
        try {
            $review->delete();
            notyf()->success('Review deleted successfully.');
            return response(['message' => 'Review deleted successfully.']);
        }
        catch (\Throwable $e) {
            logger('Error deleting review: ' . $e->getMessage());
            notyf()->error('An error occurred while deleting the review.');
            return response(["message" => $e->getMessage()], 500);
        }
    }
}
