<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Dotenv\Util\Str;
use App\Models\Review;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class StudentDashboardController extends Controller
{
    use FileUpload;


    function index(): View
    {
        return view('frontend.student-dashboard.index');
    }


    function becomeInstructor(): View
    {
        if (auth()->user()->role === 'instructor') abort(403);
        return view('frontend.student-dashboard.become-instructor.index');
    }


    function becomeInstructorUpdate(Request $request, User $user): RedirectResponse
    {
        $request->validate(['document' => ['required', 'mimes:pdf,docx,jpg,jpeg,png', 'max:2000']]);

        $filePath = $this->fileUpload($request->file('document'));
        $user->update([
            'approve_status' => 'pending',
            'document' => $filePath,
        ]);

        return redirect()->route('student.dashboard');
    }


    function review(): View
    {
        $reviews = Review::where('user_id', user()->id)->paginate(10);
        return view('frontend.student-dashboard.review.index', compact('reviews'));
    }


    function destroyReview(String $id): Response
    {
        try {
            $review = Review::where('id', $id)->where('user_id', user()->id)->firstOrFail();
            $review->delete();
            notyf()->success('Review deleted successfully.');
            return response(['message' => 'Review deleted successfully.'], 200);
        }           //code...
        catch (\Throwable $th) {
            logger('Review error: >> ' . $th);
            notyf()->error('Review deletion failed.');
            return response(['message' => 'Review deleted failed.'], 500);
        }
    }
}
