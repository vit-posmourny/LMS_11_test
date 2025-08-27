<!-- resources\views\admin\order\index.blade.php -->
@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orders</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead class="text-center">
                                <tr>
                                    <th>No.</th>
                                    <th class="text-start">Name</th>
                                    <th>Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Currency</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>
                                            <small>{{ $loop->iteration }}</small>
                                        </td>
                                        <td class="text-start">
                                            {{ $order->customer->name }} &nbsp; &nbsp;
                                            <small class="text-muted">{{ $order->customer->email }}</small>
                                        </td>
                                        <td>
                                            {{ $order->total_amount }}
                                        </td>
                                        <td>
                                            {{ $order->paid_amount }}
                                        </td>
                                        <td>
                                            {{ $order->currency }}
                                        </td>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-yellow text-yellow-fg">{{ $order->status }}</span>
                                            @else
                                                <span class="badge bg-green text-green-fg">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-sm btn-primary">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center">No data found!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-5">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
