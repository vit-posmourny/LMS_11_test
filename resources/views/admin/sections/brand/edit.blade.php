<!-- resources\views\admin\sections\brand\edit.blade.php -->
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Brands</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.brand-section.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.brand-section.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-image-preview src="{{ asset($brand->image) }}"/>
                            <label class="form-label">Brand Image</label>
                            <input type="file" class="form-control" name="image">
                            <input type="hidden" name="old_image" value="{{ $brand->image }}">
                            <x-input-error for="image" class="mt-2"/>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Url</label>
                        <input type="text" class="form-control" name="url" value="{{ $brand->url }}">
                        <x-input-error for="url" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status">
                            <option @selected($brand->status == 1) value="1">Active</option>
                            <option @selected($brand->status == 0) value="0">Inactive</option>
                        </select>
                        <x-input-error for="status" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                       <button class="btn btn-primary" type="submit">
                            <x-tabler-icon icon="device-floppy" class="icon-tabler" sprite="outline"/>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
