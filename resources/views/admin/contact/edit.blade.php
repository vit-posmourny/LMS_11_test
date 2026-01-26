<!-- resources\views\admin\contact\edit.blade.php -->
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Contact Card</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.contact.index') }}" class="btn btn-primary">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contact.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <x-image-preview src="{{ asset($contact->icon) }}" style="background-color: #b3b3b3"/>
                        <label class="form-label">Icon</label>
                        <input type="file" class="form-control" name="icon">
                        <x-input-error for="icon" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $contact->title }}">
                        <x-input-error for="title" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Line_one</label>
                        <input type="text" class="form-control" name="line_one" value="{{ $contact->line_one }}">
                        <x-input-error for="line_one" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Line_two</label>
                        <input type="text" class="form-control" name="line_two" value="{{ $contact->line_two }}">
                        <x-input-error for="line_two" class="mt-2"/>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="" class="form-select">
                            <option @selected($contact->status == 1) value="1">Active</option>
                            <option @selected($contact->status == 0) value="0">Inactive</option>
                        </select>
                        <x-input-error for="status" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                       <button class="btn btn-primary" type="submit">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
