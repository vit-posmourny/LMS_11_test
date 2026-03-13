<!-- resources\views\admin\sections\brand\index.blade.php -->
@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Brand Section</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.brand-section.create') }}" class="btn btn-primary">

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
                                    <th>Image</th>
                                    <th>Url</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $brand)
                                    <tr>
                                        <td><img src="{{ asset($brand->image) }}" style="width: 100px !important;"></td>
                                        <td>{{ $brand->url }}</td>
                                        <td>
                                            @if ($brand->status == 1)
                                                <span class="badge bg-lime text-lime-fg">Yes</span>
                                            @else
                                                <span class="badge bg-red text-red-fg">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.brand-section.edit', $brand->id) }}"
                                                class="btn-sm btn-primary">
                                                <x-tabler-icon icon="edit" class="icon-tabler" sprite="outline"/>
                                            </a>
                                            <a href="{{ route('admin.brand-section.destroy', $brand->id) }}" class="text-red delete__item">
                                                <x-tabler-icon icon="trash" class="icon-tabler" sprite="outline"/>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center">No data found!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
