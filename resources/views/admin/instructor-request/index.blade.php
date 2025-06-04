{{-- resources\views\admin\instructor-request\index.blade.php --}}
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Card title</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Doc</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($instructorRequests as $instructor)
                                <tr>
                                    <td>{{ $instructor->name }}</td>
                                    <td>{{ $instructor->email }}</td>
                                    <td>
                                        @if ($instructor->approve_status == 'pending')
                                            <span class="badge bg-yellow text-yellow-fg">Pending</span>
                                        @elseif ($instructor->approve_status == 'rejected')
                                            <span class="badge bg-red text-yellow-fg">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.instructor-doc-download', $instructor->id) }}">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-file-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005zm0 8a1 1 0 0 0 -1 1v3.585l-.793 -.792a1 1 0 0 0 -1.32 -.083l-.094 .083a1 1 0 0 0 0 1.414l2.5 2.5l.044 .042l.068 .055l.11 .071l.114 .054l.105 .035l.15 .03l.116 .006l.117 -.007l.117 -.02l.108 -.033l.081 -.034l.098 -.052l.092 -.064l.094 -.083l2.5 -2.5a1 1 0 0 0 0 -1.414l-.094 -.083a1 1 0 0 0 -1.32 .083l-.793 .791v-3.584a1 1 0 0 0 -.883 -.993zm2.999 -7.001l4.001 4.001h-4z" /></svg>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.instructor-request.update', $instructor->id) }}" method="POST" class="status-{{ $instructor->id }}">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" id="" class="form-control" onchange="$('.status-{{ $instructor->id }}').submit()">
                                                <option @selected($instructor->approve_status === 'pending') value="pending">Pending</option>
                                                <option @selected($instructor->approve_status === 'approved') value="approved">Approve</option>
                                                <option @selected($instructor->approve_status === 'rejected') value="rejected">Reject</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No Data Available!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
