{{-- resources\views\admin\course\module\index.blade.php --}}
@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Courses</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">

                            <x-tabler-icon icon="plus" style="stroke-width: 2;" class="icon-tabler" sprite="outline"/>
                            Add new
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Instructor</th>
                                    <th>Approved</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($courses as $course)
                                    <tr>
                                        <td>{{ $course->title }}</td>
                                        <td>{{ $course->price }}</td>
                                        <td>{{ $course->instructor->name }}</td>
                                        <td>
                                            @if ($course->is_approved == 'pending')
                                                <span class="badge bg-yellow text-yellow-fg">Pending</span>
                                            @elseif ($course->is_approved == 'approved')
                                                <span class="badge bg-green text-green-fg">Approved</span>
                                            @elseif ($course->is_approved == 'rejected')
                                                <span class="badge bg-red text-red-fg">Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            <select class="form-control update-approval-status" data-id="{{ $course->id }}">
                                                <option @selected($course->is_approved == 'pending') value="pending">Pending</option>
                                                <option @selected($course->is_approved == 'approved') value="approved">Approved</option>
                                                <option @selected($course->is_approved == 'rejected') value="rejected">Rejected</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.courses.edit', ['course' => $course, 'step' => '1']) }}" class="btn-sm btn-primary">
                                                <x-tabler-icon icon="edit" class="icon-tabler" sprite="outline"/>
                                            </a>
                                            <a href="{{ route('admin.course-levels.destroy', $course->id) }}" class="text-red delete-item">
                                                <x-tabler-icon icon="trash" class="icon-tabler" sprite="outline"/>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center">No data found!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-5">
                            {{ $courses->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header_scripts')
    @vite(['resources/js/admin/course.js'])
@endpush
