@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Reviews</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th colspan="2">Course</th>
                                    <th colspan="1">User</th>
                                    <th colspan="1">Rating</th>
                                    <th colspan="5">Review</th>
                                    <th colspan="1" class="text-center">Status</th>
                                    <th colspan="1" class="text-center">Change Status</th>
                                    <th colspan="1" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reviews as $review)
                                    <tr>
                                        <td colspan="2" class="text-truncate">
                                            <div>{{ $review->course->title }}</div>
                                            <span class="text-muted">{{ $review->course->instructor->name }}</span>
                                        </td>
                                        <td colspan="1" class="text-truncate">
                                            <div>{{ $review->user->name }}</div>
                                            <span class="text-muted">{{ $review->user->email }}</span>
                                        </td>
                                        <td colspan="1" style="padding-left: 1.5rem;">{{ $review->rating }}</td>
                                        <td colspan="5" class="text-truncate" style="max-width: 30vw;">{{ $review->review }}</td>
                                        <td colspan="1" class="text-center">
                                            @if ($review->status == 1)
                                                <span class="badge bg-lime text-lime-fg">Approved</span>
                                            @else
                                                <span class="badge bg-red text-red-fg">Pending</span>
                                            @endif
                                        </td>
                                        <td colspan="1" class="text-truncate">
                                            <select class="form-select">
                                                <option value="0">Pending</option>
                                                <option value="1">Approved</option>
                                            </select>
                                        </td>
                                        <td colspan="1" class="text-center">
                                            <a href="{{ route('admin.course-levels.destroy', $review->id) }}" class="text-red delete__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="12" class="text-center">No data found!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-5">
                            {{ $reviews->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
