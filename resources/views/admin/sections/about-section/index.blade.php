<!-- resources\views\admin\sections\about-section\index.blade.php -->
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">About Us Section</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-levels.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.about-section.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <x-image-preview id="preview1" src="{{ asset($about->image) }}"/>
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control fileInput" name="image" data-preview="preview1">
                                <input type="hidden" name="old_image" value="{{ $about->image }}">
                                <x-input-error for="image" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Rounded Text</label>
                                <input type="text" class="form-control" name="rounded_text" value="{{ old('rounded_text', $about->rounded_text) }}">
                                <x-input-error for="rounded_text" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Learner Count</label>
                                <input type="text" class="form-control" name="learner_count" value="{{ old('learner_count', $about->learner_count) }}">
                                <x-input-error for="learner_count" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Learner Count Text</label>
                                <input type="text" class="form-control" name="learner_count_text" value="{{ old('learner_count_text', $about->learner_count_text) }}">
                                <x-input-error for="learner_count_text" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <x-image-preview id="preview2" src="{{ asset($about->learner_image) }}"/>
                                <label class="form-label">Learner Image</label>
                                <input type="file" class="form-control fileInput" name="learner_image" data-preview="preview2">
                                <input type="hidden" name="old_learner_image" value="{{ $about->learner_image }}">
                                <x-input-error for="learner_image" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">About Title</label>
                                <input type="text" class="form-control" name="about_title" value="{{ old('about_title', $about->title) }}">
                                <x-input-error for="about_title" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">About Description</label>
                                <textarea class="editor" name="about_description">{!! $about->description !!}</textarea>
                                <x-input-error for="about_description" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Button Text</label>
                                <input type="text" class="form-control" name="button_text" value="{{ old('button_text', $about->button_text) }}">
                                <x-input-error for="button_text" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Button Url</label>
                                <input type="text" class="form-control" name="button_url" value="{{ old('button_url', $about->button_url) }}">
                                <x-input-error for="button_url" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <x-image-preview id="preview3" src="{{ asset($about->video_image) }}"/>
                                <label class="form-label">Video Image</label>
                                <input type="file" class="form-control fileInput" name="video_image" data-preview="preview3">
                                <input type="hidden" name="old_video_image" value="{{ $about->video_image }}">
                                <x-input-error for="video_image" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Video Url</label>
                                <input type="text" class="form-control" name="video_url" value="{{ old('video_url', $about->video_url) }}">
                                <x-input-error for="video_url" class="mt-2"/>
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
@push('header_scripts')
    <script src="https://cdn.tiny.cloud/1/jkx2gs8cwid6kn4mbyrcm88yn6h065ohcto5zckgsisdztl8/tinymce/8/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>
@endpush
@push('scripts')
    @vite(['resources/js/admin/tinymce-init.js', 'resources/js/analyzeImages.js'])
@endpush
