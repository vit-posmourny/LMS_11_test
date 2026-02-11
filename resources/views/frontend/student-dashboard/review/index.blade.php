<!-- resources\views\frontend\instructor-dashboard\orders\index.blade.php -->
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
                            <li>Student Dashboard / Reviews</li>
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
<section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
    <div class="container">
        <div class="row">
            @include('frontend.student-dashboard.sidebar')
            <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                <div class="wsus__dashboard_contant">
                    <div class="wsus__dashboard_contant_top">
                        <div class="wsus__dashboard_heading relative">
                            <h5>Courses</h5>
                            <p>Manage your courses and its update like live, draft and insight.</p>
                        </div>
                    </div>
                    <div class="wsus__dash_course_table">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <th>Course Name</th>
                                <th class="text-center">Rating</th>
                                <th class="text-center">Review</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                @forelse ($reviews as $review)
                                <tr>
                                    <td>{{ $review->course->title }}</td>
                                    <td class="text-center">{{ $review->rating }}</td>
                                    <td class="text-center">{{ $review->review }}</td>
                                    <td class="text-center">
                                        @if ($review->status == '1')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('student.review.destroy', $review->id) }}" class="text-danger delete__item">
                                            <x-tabler-icon icon="trash" class="icon-tabler" sprite="outline"/>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Data Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
