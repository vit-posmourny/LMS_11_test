<!-- resources\views\admin\sections\featured-instructor\index.blade.php -->
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Featured Instructor Section</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.featured-instructor-section.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                 <input type="text" class="form-control" name="title" value="{{ $featuredInstructor?->title }}">
                                <x-input-error for="title" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Subtitle</label>
                                <textarea name="subtitle" class="form-control">{{ $featuredInstructor?->subtitle }}</textarea>
                                <x-input-error for="subtitle" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Button Text</label>
                                <input type="text" class="form-control" name="button_text" value="{{ $featuredInstructor?->button_text }}">
                                <x-input-error for="button_text" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Button Url</label>
                                <input type="text" class="form-control" name="button_url" value="{{ $featuredInstructor?->button_url }}">
                                <x-input-error for="button_url" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Instructor</label>
                                <select name="instructor_id" class="select2 select_instructor">
                                    <option value="">Select</option>
                                    @foreach ($instructors as $instructor)
                                        <option @selected( $featuredInstructor?->instructor_id == $instructor->id ) value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="instructor" class="mt-2"/>
                            </div>
                        </div>
                        {{-- @dd($selectedInstructorCourses) --}}
                        {{-- @dd($allInstructorCourses) --}}
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Courses</label>
                                <select name="featured_courses[]" class="select2 select_instructor_courses" multiple>
                                    @foreach ($allInstructorCourses as $course)
                                        <option
                                            value="{{ $course->id }}"
                                            @selected($selectedInstructorCourses->contains($course->title))
                                        >
                                            {{ $course->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for="featured_courses.*" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                 <x-image-preview src="{{ asset($featuredInstructor?->instructor_image) }}" style="background-color: #b3b3b3"/>
                                <label class="form-label">Instructor Image</label>
                                <input type="file" class="form-control" name="instructor_image">
                                <input type="hidden" name="old_instructor_image" value="{{ $featuredInstructor?->instructor_image }}">
                                <x-input-error for="instructor_image" class="mt-2"/>
                            </div>
                        </div>
                        <div class="my-3 ms-2">
                            <button class="btn btn-primary" type="submit">
                                <x-tabler-icon icon="device-floppy" class="icon-tabler" sprite="outline"/>
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
