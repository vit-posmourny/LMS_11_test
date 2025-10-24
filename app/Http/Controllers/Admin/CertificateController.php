<?php

namespace App\Http\Controllers\Admin;

use App\Models\CertificateBuilder;
use App\Http\Controllers\Controller;
use App\Models\CertificateBuilderItem;
use Barryvdh\DomPDF\Facade\Pdf;

use Dompdf\Dompdf;

require '../vendor/autoload.php';

class CertificateController extends Controller
{

    function index()
    {
        $certificate = CertificateBuilder::first();
        $certificateItems = CertificateBuilderItem::all();

        $pdf = Pdf::loadView('frontend.student-dashboard.enrolled-courses.certificate', compact('certificate', 'certificateItems'))->stream();
        return $pdf;
    }
}
