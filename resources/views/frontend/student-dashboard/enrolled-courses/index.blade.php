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
                            <h1>Student Dashboard</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Student Dashboard / Enrolled Courses</li>
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
                @include('frontend.student-dashboard.sidebar')
                <div class="col-xl-9 col-md-8">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading relative">
                                <h5>Courses</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>

                        <form action="#" class="wsus__dash_course_searchbox">
                            <div class="input">
                                <input type="text" placeholder="Search our Courses">
                                <button><i class="fas fa-search" aria-hidden="true"></i></button>
                            </div>
                            <div class="selector">
                                <select class="select_js" style="display: none;">
                                    <option value="">Choose</option>
                                    <option value="">Choose 1</option>
                                    <option value="">Choose 2</option>
                                </select><div class="nice-select select_js" tabindex="0"><span class="current">Choose</span><ul class="list"><li data-value="" class="option selected">Choose</li><li data-value="" class="option">Choose 1</li><li data-value="" class="option">Choose 2</li></ul></div>
                            </div>
                        </form>

                        <div class="wsus__dash_course_table">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        COURSES
                                                    </th>
                                                    <th>
                                                        DETAILS
                                                    </th>
                                                    <th class="text-center">
                                                        ACTION
                                                    </th>
                                                </tr>
                                            @forelse ($enrollments as $enrollment)
                                                <tr>
                                                    <td class="image col-3">
                                                        <div class="image_category">
                                                            <img src="{{ asset($enrollment->course->thumbnail) }}" alt="course-thumbnail" class="img-fluid w-100">
                                                        </div>
                                                    </td>
                                                    <td class="details col-4">
                                                        <p class="rating">
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <span>(5.0)</span>
                                                        </p>
                                                        <a class="title" href="#">{{ $enrollment->course->title }}</a>
                                                        <div class="mb-1"><small class="text-muted">By</small> {{ $enrollment->course->instructor->name }}</div>
                                                        <span>{{ $enrollment->course->seo_description }}</span>
                                                    </td>
                                                    <td class="text-center col-2">
                                                        <a href="" class="btn btn-outline-info">Watch Course</a>
                                                    </td>
                                                    <td class="col-3"></td>
                                                </tr>
                                            @empty
                                                <tr colspan="12">
                                                    <td class="text-center">No Data Found</td>
                                                </tr>
                                            @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
