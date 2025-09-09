@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payout Details</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.withdraw-request.index') }}" class="btn btn-primary">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <tbody>
                                <tr>
                                    <td>Instructor</td>
                                    <td>
                                        {{ $withdraw->instructor->name }} &nbsp; &nbsp;
                                        <small class="text-muted">{{ $withdraw->instructor->email }}</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Current Wallet Ballance</td>
                                    <td>
                                        {{ config('settings.currency_icon') }} {{ $withdraw->instructor->wallet }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Payout Amount</td>
                                    <td>
                                        {{ config('settings.currency_icon') }} {{ $withdraw->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        @if ($withdraw->status === 'pending')
                                            <span class="badge bg-yellow text-yellow-fg">Pending</span>
                                        @elseif ($withdraw->status === 'approved')
                                            <span class="badge bg-green text-green-fg">Approved</span>
                                        @elseif ($withdraw->status === 'rejected')
                                            <span class="badge bg-red text-red-fg">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Action</td>
                                    <td>
                                        <div style="width: 300px">
                                            <div class="alert alert-danger">After updating status, you can't revert it.</div>
                                            <form class="form-control" action="{{ route('admin.withdraw-request.status.update', $withdraw) }}" method="POST">
                                                @csrf
                                                <label class="form-label">Status</label>
                                                <select class="form-select w-8" name="status" @disabled($withdraw->status !== 'pending')>
                                                    <option @selected($withdraw->status === "pending") value="pending">Pending</option>
                                                    <option @selected($withdraw->status === "approved") value="approved">Approve</option>
                                                    <option @selected($withdraw->status === "rejected") value="rejected">Reject</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
