<?php

namespace App\Http\Controllers\Admin;

use App\Models\CertificateBuilder;
use App\Http\Controllers\Controller;
use App\Models\CertificateBuilderItem;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{

    function index()
    {
        $certificate = CertificateBuilder::first();
        $certificateItem = CertificateBuilderItem::first();

        $pdf = Pdf::loadView('frontend.student-dashboard.enrolled-courses.certificate', compact('certificate', 'certificateItem'))->stream();
        return $pdf;

       // return view('frontend.student-dashboard.enrolled-courses.certificate', compact('certificate', 'certificateItem'));
    }
}
