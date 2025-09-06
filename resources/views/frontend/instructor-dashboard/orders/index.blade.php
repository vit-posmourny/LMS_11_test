<!-- resources\views\frontend\instructor-dashboard\orders\index.blade.php -->
@extends('frontend.layouts.master')

@section('content')
<!--===========================
        BREADCRUMB START
============================-->
<section class="wsus__breadcrumb" style="background: url(images/breadcrumb_bg.jpg);">
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
<section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
    <div class="container">
        <div class="row">
            @include('frontend.instructor-dashboard.sidebar')
            <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                <div class="wsus__dashboard_contant">
                    <div class="table-responsive mx-lg-5">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <th>Course Name</th>
                            <th>Purchase by</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Commission</th>
                            <th class="text-start">Earning</th>
                        </thead>
                        <tbody>
                            @forelse ($orderItems as $item)
                            <tr>
                                <td>{{ $item->course->title }}</td>
                                <td>{{ $item->order->customer->name }}</td>
                                <td class="text-center">{{ $item->course->discount_price === 0 ? $item->course->price : $item->course->discount_price }}</td>
                                <td class="text-center">{{ $item->commission_rate ?? 0 }}%</td>
                                <td class="text-start ">{{ calculateCommission($item->course->discount_price === 0 ? $item->course->price : $item->course->discount_price , $item->commission_rate) }}&nbsp;&nbsp{{ Str::of($item->order->currency)->upper() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td>No Data Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                    <div class="mt-5 mb-3 mx-lg-5">
                        {{ $orderItems->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
