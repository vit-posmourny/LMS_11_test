<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CertificateBuilder;
use App\Http\Controllers\Controller;
use App\Models\CertificateBuilderItem;
use App\Models\Enrollment;


require '../vendor/autoload.php';

class CertificateController extends Controller
{

    function download($id)
    {
        $course = Course::findOrFail($id);

        if (!Enrollment::where('user_id', user()->id)->where('course_id', $id)->where('completed', true)->exists()) {
            return abort(404);
        }

        $certificate = CertificateBuilder::first();
        $certificateItems = CertificateBuilderItem::all();

        $html = view('frontend.student-dashboard.enrolled-courses.certificate', compact('certificate', 'certificateItems'))->render();
        $html = str_replace("[student_name]", user()->name, $html);
        $html = str_replace("[course_name]", $course->title, $html);
        $html = str_replace("[date]", date('d-m-Y'), $html);
        $html = str_replace("[platform_name]", 'EduCore', $html);
        $html = str_replace("[instructor_name]", $course->instructor->name, $html);

        $pdf = pdf::loadHTML($html);
        return $pdf->stream('certificate.pdf');
    }
}
