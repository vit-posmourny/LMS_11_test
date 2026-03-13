@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Course Levels</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.course-levels.create') }}" class="btn btn-primary">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($levels as $level)
                                    <tr>
                                        <td>{{ $level->name }}</td>
                                        <td>{{ $level->slug }}</td>
                                        <td>
                                            <a href="{{ route('admin.course-levels.edit', $level) }}"
                                                class="btn-sm btn-primary">
                                                <x-tabler-icon icon="edit" class="icon-tabler" sprite="outline"/>
                                            </a>
                                            <a href="{{ route('admin.course-levels.destroy', $level->id) }}" class="text-red delete__item">
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
                            {{ $levels->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
