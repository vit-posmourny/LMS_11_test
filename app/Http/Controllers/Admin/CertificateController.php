<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CertificateBuilder;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\CertificateBuilderItem;

class CertificateController extends Controller
{

    function index(): View
    {
        $certificate = CertificateBuilder::first();
        $certificateItem = CertificateBuilderItem::first();

        return view('frontend.student-dashboard.enrolled-courses.certificate', compact('certificate', 'certificateItem'));
    }
}
