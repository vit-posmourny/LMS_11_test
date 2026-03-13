@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Blog Categories</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary">
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
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if ($category->status)
                                            <span class="badge bg-lime text-lime-fg">Yes</span>
                                        @else
                                            <span class="badge bg-pink text-pink-fg">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.blog-categories.edit', $category->id) }}" class="text-blue">
                                            <x-tabler-icon icon="edit" class="icon-tabler" sprite="outline"/>
                                        </a>
                                        <a href="{{ route('admin.blog-categories.destroy', $category->id) }}" class="text-red delete__item">
                                            <x-tabler-icon icon="trash" class="icon-tabler" sprite="outline"/>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center">No data found!</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
