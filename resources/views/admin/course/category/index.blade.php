<!-- resources\views\admin\course\category\index.blade.php  -->
@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Course Categories</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.course-categories.create') }}" class="btn btn-primary">
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
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Trending</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>
                                            <svg class="icon icon-tabler-course-categories">
                                                <use href="{{ asset('tabler/icons-sprite/tabler-sprite.svg') }}#{{ $category->icon }}"></use>
                                            </svg>
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            @if ($category->show_at_trending)
                                                <span class="badge bg-lime text-lime-fg">Yes</span>
                                            @else
                                                <span class="badge bg-pink text-pink-fg">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($category->status)
                                                <span class="badge bg-lime text-lime-fg">Yes</span>
                                            @else
                                                <span class="badge bg-pink text-pink-fg">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.sub-categories.index', $category->id) }}" class="btn-sm btn-primary text-yellow">
                                                <x-tabler-icon icon="list" class="icon-tabler" sprite="outline"/>
                                            </a>
                                            <a href="{{ route('admin.course-categories.edit', $category) }}"
                                                class="btn-sm btn-primary">
                                                <x-tabler-icon icon="edit" class="icon-tabler" sprite="outline"/>
                                            </a>
                                            <a href="{{ route('admin.course-categories.destroy', $category->id) }}" class="text-red delete__item">
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
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
