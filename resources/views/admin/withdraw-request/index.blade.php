@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payout Requests</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-start">Instructor</th>
                                    <th>Payout Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($withdraws as $withdraw)
                                    <tr class="text-center">
                                        <td class="text-start">{{ $withdraw->instructor->name }}</td>
                                        <td>{{ config('settings.currency_icon') }} {{ $withdraw->amount }}</td>
                                        <td>
                                            @if ($withdraw->status === 'pending')
                                                <span class="badge bg-yellow text-yellow-fg">Pending</span>
                                            @elseif ($withdraw->status === 'approved')
                                                <span class="badge bg-green text-green-fg">Approved</span>
                                            @elseif ($withdraw->status === 'rejected')
                                                <span class="badge bg-red text-red-fg">Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.withdraw-request.show', $withdraw) }}" class="text-blue">
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
                            {{ $withdraws->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
