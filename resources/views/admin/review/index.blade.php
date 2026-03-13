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
                                            <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-select" onchange="this.form.submit()">
                                                    <option @selected($review->status == 0) value="0">Pending</option>
                                                    <option @selected($review->status == 1) value="1">Approved</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td colspan="1" class="text-center">
                                            <a href="{{ route('admin.reviews.destroy', $review->id) }}" class="text-red delete__item">
                                                <x-tabler-icon icon="trash" class="icon-tabler" sprite="outline"/>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="12" class="text-center text-muted">No data found!</td></tr>
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
