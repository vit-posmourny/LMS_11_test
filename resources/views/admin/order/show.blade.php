<!-- resources\views\admin\order\show.blade.php -->
@extends('admin.layouts.master')

@section('content')
<div class="page-wrapper">
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Invoice</h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/printer -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-1">
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                            </path>
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z">
                            </path>
                        </svg>
                        Print Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card card-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="h3">Company</p>
                            <address>
                                Street Address<br>
                                State, City<br>
                                Region, Postal Code<br>
                                ltd@example.com
                            </address>
                        </div>
                        <div class="col-6 text-end">
                            <p class="h3">Client</p>
                            <address>
                                {{ $order->customer->name }}<br>
                                {{ $order->customer->email }}
                            </address>
                        </div>
                        <div class="col-12 my-5">
                            <h1>Invoice #{{ $order->invoice_id }}</h1>
                        </div>
                    </div>
                    <table class="table table-transparent table-responsive">
                        <thead>
                            <tr>
                                <th class="col-1 text-center">No.</th>
                                <th class="col-9">Product</th>
                                <th class="col-1 text-center">Qnt</th>
                                <th class="col-1 text-center">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($order->orderItems as $item )
                            <tr>
                                <td class="col-1 text-center"><small>{{ $loop->iteration }}</small></td>
                                <td class="col-9">
                                    <p class="strong mb-1">{{ $item->course->title }}</p>
                                    <div class="text-secondary">&nbsp;by {{ $item->course->instructor->name }}</div>
                                </td>
                                <td class="col-1 text-center">1</td>
                                <td class="col-1 text-end pe-5">{{ $item->price }}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="3" class="strong text-end">Subtotal</td>
                                <td colspan="1" class="text-end">{{ $order->total_amount }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="strong text-end">Paid Amount</td>
                                <td colspan="1" class="text-end">{{ $order->paid_amount }} {{ $order->currency }}</td>
                            </tr>

                    </table>
                    <p class="text-secondary text-center mt-5">Thank you very much for doing business with us. We look
                        forward to working with you again!</p>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE BODY -->
</div>
@endsection
 