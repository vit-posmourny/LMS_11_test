<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CertificateBuilderUpdateRequest;
use App\Models\CertificateBuilder;
use App\Models\CertificateBuilderItem;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CertificateBuilderController extends Controller
{

    use FileUpload;

    function index(): View
    {
        $certificate = CertificateBuilder::first();
        $certificateItem = CertificateBuilderItem::first();

        return view('admin.certificate-builder.index', compact('certificate', 'certificateItem'));
    }

    /**
     * Update the certificate settings.
     *
     * @param CertificateBuilderUpdateRequest $request
     * @return RedirectResponse
    */
    function update(CertificateBuilderUpdateRequest $request): RedirectResponse
    {
        $data = ['title' => $request->title, 'subtitle' => $request->subtitle, 'description' => $request->description];

        if ($request->hasFile('signature'))
        {
            $signature = $this->fileUpload($request->file('signature'));
            $data['signature'] = $signature;
        }

        if ($request->hasFile('background'))
        {
            $background = $this->fileUpload($request->file('background'));
            $data['background'] = $background;
        }

        CertificateBuilder::updateOrCreate(
            ['id' => 1],
            $data,
        );

        notyf()->success("Create or Update Certificate sucessfully.");

        return redirect()->back();
    }


    function itemUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'elementId' => 'required|in:signature',
        ]);

        CertificateBuilderItem::updateOrCreate([
            'elementId' => $request->elementId,
        ],[
            'x_position' => $request->x_position.'px',
            'y_position' => $request->y_position.'px',
            'saved' => $request->saved,
        ]);

        return redirect()->back();
    }
}
