<!-- resources\views\admin\contact\create.blade.php -->
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Contact Card</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.contact.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contact.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <x-image-preview src="" style="background-color: #b3b3b3"/>
                        <label class="form-label">Icon</label>
                        <input type="file" class="form-control" name="icon">
                        <input type="hidden" name="old_image_two" value="">
                        <x-input-error for="icon" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title">
                        <x-input-error for="title" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Line_one</label>
                        <input type="text" class="form-control" name="line_one">
                        <x-input-error for="line_one" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Line_two</label>
                        <input type="text" class="form-control" name="line_two">
                        <x-input-error for="line_two" class="mt-2"/>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <x-input-error for="status" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                       <button class="btn btn-primary" type="submit">
                            <x-tabler-icon icon="device-floppy" class="icon-tabler" sprite="outline"/>
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
