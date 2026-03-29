<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Traits\FileUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    use FileUpload;

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
            'mail_mailer' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|numeric',
            'mail_username' => 'required|string|max:255',
            'mail_password' => 'required|string|max:255',
            'mail_encryption' => 'required|string|max:255',
            'mail_queue' => 'required|string|max:255',
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


    function logoSettingsIndex(): View
    {
        return view('admin.settings.logo');
    }


    function updateLogoSettings(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_breadcrumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ZÍSKÁME STARÉ CESTY K OBRÁZKŮM PRO PŘÍPADNÉ ODSTRANĚNÍ
        $old_site_logo = Setting::where('key', 'site_logo')->value('value');
        $old_site_footer_logo = Setting::where('key', 'site_footer_logo')->value('value');
        $old_site_favicon = Setting::where('key', 'site_favicon')->value('value');
        $old_site_breadcrumb = Setting::where('key', 'site_breadcrumb')->value('value');

        // ZPRACUJEME NOVÉ OBRÁZKY A ULOŽÍME JE, PŘIČEMŽ ULOŽÍME NOVÉ CESTY DO $validateData
        if ($request->hasFile('site_logo')) {
            $validateData['site_logo'] = $this->fileUpload($request->file('site_logo'));
        }

        if ($request->hasFile('site_footer_logo')) {
            $validateData['site_footer_logo'] = $this->fileUpload($request->file('site_footer_logo'));
        }

        if ($request->hasFile('site_favicon')) {
            $validateData['site_favicon'] = $this->fileUpload($request->file('site_favicon'));
        }

        if ($request->hasFile('site_breadcrumb')) {
            $validateData['site_breadcrumb'] = $this->fileUpload($request->file('site_breadcrumb'));
        }


        foreach ($validateData as $key => $value)
        {
            Setting::updateOrCreate([
                'key' => $key
            ],[
                'value' => $value
            ]);
        }

        // ZDE MAŽEME STARÉ OBRÁZKY POUZE V PŘÍPADĚ, ŽE BYL NAHRÁN NOVÝ OBRÁZEK A STARÁ CESTA EXISTUJE
        if ($request->hasFile('site_logo') && $old_site_logo)
        {
            if($this->deleteFile($old_site_logo)) {
                // notyf()->success('Old image deleted successfully.');
            }else {
                notyf()->error('Old old_site_logo not found or could not be deleted.');
            }
        }
        if ($request->hasFile('site_footer_logo') && $old_site_footer_logo)
        {
            if($this->deleteFile($old_site_footer_logo)) {
                // notyf()->success('Old image deleted successfully.');
            }else {
                notyf()->error('Old old_site_footer_logo not found or could not be deleted.');
            }
        }
        if ($request->hasFile('site_favicon') && $old_site_favicon)
        {
            if($this->deleteFile($old_site_favicon)) {
                // notyf()->success('Old image deleted successfully.');
            }else {
                notyf()->error('Old old_site_favicon not found or could not be deleted.');
            }
        }
        if ($request->hasFile('site_breadcrumb') && $old_site_breadcrumb)
        {
            if($this->deleteFile($old_site_breadcrumb)) {
                // notyf()->success('Old image deleted successfully.');
            }else {
                notyf()->error('Old old_site_breadcrumb not found or could not be deleted.');
            }
        }


        Cache::forget('settings');
        config()->set('settings', Setting::pluck('value', 'key')->toArray());

        notyf()->success('Update Logo Settings successfully.');
        return redirect()->back();
    }
}
