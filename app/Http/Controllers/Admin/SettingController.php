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
        return view('admin.settings.main-panel');
    }


    function  updateMainSettings(Request $request): RedirectResponse
    {   //dd($request->all());
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

        notyf()->success('Update Main-Settings Successfully.');
        return redirect()->back();
    }
}
