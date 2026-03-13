@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Video Section</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-levels.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.video-section.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <x-image-preview src="{{ asset($video?->background) }}" style="background-color: #b3b3b3"/>
                                <label class="form-label">Background</label>
                                <input type="file" class="form-control" name="background">
                                <input type="hidden" name="old_background" value="{{ $video?->background }}">
                                <x-input-error for="background" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <div class="mb-3">
                                <label class="form-label">Video Url</label>
                                <input type="text" class="form-control" name="video_url" value="{{ old('video_url', $video?->video_url) }}">
                                <x-input-error for="video_url" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description">{!! old('description', $video?->description) !!}</textarea>
                                <x-input-error for="description" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Button Text</label>
                                <input type="text" class="form-control" name="button_text" value="{{ old('button_text', $video?->button_text) }}">
                                <x-input-error for="button_text" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Button Url</label>
                                <input type="text" class="form-control" name="button_url" value="{{ old('button_url', $video?->button_url) }}">
                                <x-input-error for="button_url" class="mt-2"/>
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
