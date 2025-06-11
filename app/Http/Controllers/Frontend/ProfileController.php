<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Frontend\ProfileUpdateRequest;


class ProfileController extends Controller
{
    function index(): View
    {
        return view('frontend.student-dashboard.profile.index');
    }


    function profileUpdate(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->headline = $request->headline;
        $user->gender = $request->gender;
        $user->bio = $request->bio;

        $user->save();

        return redirect()->back();
    }
}
