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
use Illuminate\Http\Response;

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
        $imageInfo = [];

        if ($request->hasFile('signature'))
        {
            $signature = $this->fileUpload($request->file('signature'));
            $data['signature'] = $signature;

        }

        if ($request->hasFile('background'))
        {
            $file = $request->file('background');
            $imageInfo = getimagesize($file->getRealPath());
            $background = $this->fileUpload($file);
            $data['background'] = $background;
            $data['bg_width'] = $imageInfo[0];
            $data['bg_height'] = $imageInfo[1];
        }

        CertificateBuilder::updateOrCreate(
            ['id' => 1],
            $data,
        );

        return redirect()->route('admin.certificate-builder.index');
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
