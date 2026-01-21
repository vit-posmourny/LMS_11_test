@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Testimonial</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.testimonial-section.index') }}" class="btn btn-primary">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.testimonial-section.update', $testimonial_section->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select name="rating" class="form-select">
                            <option @selected($testimonial_section->rating == 5) value="5">5</option>
                            <option @selected($testimonial_section->rating == 4) value="4">4</option>
                            <option @selected($testimonial_section->rating == 3) value="3">3</option>
                            <option @selected($testimonial_section->rating == 2) value="2">2</option>
                            <option @selected($testimonial_section->rating == 1) value="1">1</option>
                        </select>
                        <x-input-error for="rating" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Review</label>
                        <textarea name="review" class="form-control">{{ $testimonial_section->review }}</textarea>
                        <x-input-error for="review" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <x-image-preview src="{{ asset($testimonial_section->user_image) }}" style="background-color: #b3b3b3"/>
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                        <input type="hidden" name="old_image" value="{{ $testimonial_section->user_image }}">
                        <x-input-error for="image" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $testimonial_section->user_name }}">
                        <x-input-error for="name" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $testimonial_section->user_title }}">
                        <x-input-error for="title" class="mt-2"/>
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
