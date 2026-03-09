<!-- resources\views\frontend\pages\custom-page .blade.php -->
@extends('frontend.layouts.master')

@push('header_styles')
    <style>
        h1 {
            margin-top: 2rem;
            margin-bottom: 1.5rem;
        }
        h2, h3, h4, h5, h6 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }
        p {
            margin-bottom: 1rem;
        }
    </style>
@endpush

@section('content')
<!--===========================
    BREADCRUMB START
============================-->
<section class="wsus__breadcrumb" style="background: url({{ Vite::asset('resources/images/breadcrumb_bg.jpg') }});">
    <div class="wsus__breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp">
                    <div class="wsus__breadcrumb_text">
                        <h1>{{ $customPage->title }}</h1>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>{{ $customPage->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--===========================
    BREADCRUMB END
============================-->


<!--===========================
    CUSTOM-PAGE START
============================-->
<section class="wsus__contact_us mt_95 xs_mt_75 pb_120 xs_pb_100">
    <div class="container">

        <div class="wsus__contact_form_area mt_30 wow fadeInUp">
            {!! $customPage->description !!}
        </div>
    </div>
</section>
<!--===========================
    CUSTOM-PAGE END
============================-->
@endsection
