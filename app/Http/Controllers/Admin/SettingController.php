<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{

    function index(): View
    {
        return view('admin.settings.general');
    }


    function  updateGeneralSettings(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'site_name' => 'required',
            'phone_number' => 'nullable',
            'location' => 'nullable',
            'default_currency' => 'required',
            'currency_icon' => 'nullable',
        ]);

        foreach ($validateData as $key => $value)
        {
            Setting::updateOrCreate([
                'key' => $key
            ],[
                'value' => $value
            ]);
        }

        Cache::forget('settings');

        notyf()->success('Update General-Settings Successfully.');
        return redirect()->back();
    }


    function commissionSettings(): View
    {
        return view('admin.settings.commission');
    }


    function updateCommissionSettings(Request $request) : RedirectResponse
    {
        $validateData = $request->validate([
            'commission_rate' => 'required|numeric',
        ]);

        foreach ($validateData as $key => $value)
        {
            Setting::updateOrCreate([
                'key' => $key
            ],[
                'value' => $value
            ]);
        }

        Cache::forget('settings');

        notyf()->success('Update General-Settings Successfully.');
        return redirect()->back();
    }


    function smtpSettings(): View
    {
        return view('admin.settings.smtp-settings');
    }


    function updateSmtpSettings(Request $request) : RedirectResponse
    {
        $validateData = $request->validate([
            'sender_email' => 'required|email',
            'receiver_email' => 'required|email',
        ]);

        foreach ($validateData as $key => $value)
        {
            Setting::updateOrCreate([
                'key' => $key
            ],[
                'value' => $value
            ]);
        }

        Cache::forget('settings');

        notyf()->success('Update SMTP Settings successfully.');
        return redirect()->back();
    }
}
