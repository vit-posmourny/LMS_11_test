<?php

namespace App\Http\Controllers\Frontend;

use App\Traits\FileUpload;
use Illuminate\Http\Request;
use App\Models\PayoutGateway;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\InstructorPayoutInformation;
use App\Http\Requests\Frontend\SocialUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Http\Requests\Frontend\PasswordUpdateRequest;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{

    use FileUpload;

    function index(): View
    {
        return view('frontend.student-dashboard.profile.index');
    }


    function instructorIndex(): View
    {
        $gateways = PayoutGateway::where('status', 1)->get();
        return view('frontend.instructor-dashboard.profile.index', compact('gateways'));
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

        flash()->option('position', 'bottom-right')->success('Your profile has been updated successfully.');

        return redirect()->back();
    }


    function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $user->password = bcrypt($request->new_password);
        $user->save();

        flash()->option('position', 'bottom-right')->success('Your password has been updated successfully.');

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

        flash()->option('position', 'bottom-right')->success('Your socials has been updated successfully.');

        return redirect()->back();
    }


    function updateGatewayInfo(Request $request): RedirectResponse
    {
        InstructorPayoutInformation::updateOrCreate(
            ['instructor_id' => user()->id],
            [
                'gateway' => $request->gateway_name,
                'information' => $request->gateway_info,
            ]
         );

         notyf()->success('Payout Gateway Info Updated Successfully.');

         return redirect()->back();
    }
}
