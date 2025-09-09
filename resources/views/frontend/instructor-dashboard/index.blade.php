{{-- resources\views\frontend\instructor-dashboard\index.blade.php --}}
@extends('frontend.layouts.master')

@section('content')
<!--===========================
        BREADCRUMB START
============================-->
<section class="wsus__breadcrumb" style="background: url({{ asset('frontend/assets/images/breadcrumb_bg.jpg') }});">
    <div class="wsus__breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp">
                    <div class="wsus__breadcrumb_text">
                        <h1>Instructor Dashboard</h1>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>Instructor Dashboard</li>
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
        DASHBOARD OVERVIEW START
============================-->
<section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
    <div class="container">
        <div class="row">
            @include('frontend.instructor-dashboard.sidebar')
            <div class="col-xl-9 col-md-8">
                @if (auth()->user()->approve_status === 'pending')
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </symbol>
                </svg>
                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                        <div>
                            Hi, {{ auth()->user()->name }}. Your instructor request is currently pending. We will send a message on your email, when it will be approved.
                        </div>
                    </div>
                @endif
                <div class="text-end">
                    <a href="{{ route('student.become-instructor') }}" class="btn btn-primary">Become an Instructor</a>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-sm-6 wow fadeInUp">
                        <div class="wsus__dash_earning">
                            <h6>REVENUE</h6>
                            <h3>$2456.34</h3>
                            <p>Earning this month</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 wow fadeInUp">
                        <div class="wsus__dash_earning">
                            <h6>STUDENTS ENROLLMENTS</h6>
                            <h3>16,450</h3>
                            <p>Progress this month</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 wow fadeInUp">
                        <div class="wsus__dash_earning">
                            <h6>COURSES RATING</h6>
                            <h3>4.70</h3>
                            <p>Rating this month</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--===========================
        DASHBOARD OVERVIEW END
============================-->
@endsection
