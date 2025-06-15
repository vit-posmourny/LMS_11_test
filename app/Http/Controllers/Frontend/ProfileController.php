<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Http\Requests\Frontend\PasswordUpdateRequest;
use App\Http\Requests\Frontend\SocialUpdateRequest;
use App\Traits\FileUpload;

class ProfileController extends Controller
{

    use FileUpload;

    function index(): View
    {
        return view('frontend.student-dashboard.profile.index');
    }


    function instructorIndex(): View
    {
        return view('frontend.instructor-dashboard.profile.index');
    }


    function profileUpdate(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        if ($request->hasFile('avatar'))
        {
            $this->deleteFile($user->avatar);
            $user->avatar = $this->fileUpload($request->file('avatar'));
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->headline = $request->headline;
        $user->gender = $request->gender;
        $user->bio = $request->bio;
        $user->save();

        return redirect()->back();
    }


    function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back();
    }


    function updateSocial(SocialUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $user->facebook = $request->facebook;
        $user->x = $request->x;
        $user->linkedin = $request->linkedin;
        $user->website = $request->website;
        $user->save();

        return redirect()->back();
    }
}
