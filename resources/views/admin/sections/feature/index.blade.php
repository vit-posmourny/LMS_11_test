@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Feature Section</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-levels.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.feature.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <x-image-preview src="{{ asset($feature->image_one) }}" style="background-color: #b3b3b3"/>
                                <label class="form-label">Image One</label>
                                <input type="file" class="form-control" name="image_one">
                                <input type="hidden" name="old_image_one" value="{{ $feature->image_one }}">
                                <x-input-error for="image_one" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title One</label>
                                <input type="text" class="form-control" name="title_one" value="{{ old('title_one', $feature->title_one) }}">
                                <x-input-error for="title_one" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Subtitle One</label>
                                <input type="text" class="form-control" name="subtitle_one" value="{{ old('subtitle_one', $feature->subtitle_one) }}">
                                <x-input-error for="subtitle_one" class="mt-2"/>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <x-image-preview src="{{ asset($feature->image_two) }}" style="background-color: #b3b3b3"/>
                                <label class="form-label">Image Two</label>
                                <input type="file" class="form-control" name="image_two">
                                <input type="hidden" name="old_image_two" value="{{ $feature->image_two }}">
                                <x-input-error for="image_two" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title Two</label>
                                <input type="text" class="form-control" name="title_two" value="{{ old('title_two', $feature->title_two) }}">
                                <x-input-error for="title_two" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Subtitle Two</label>
                                <input type="text" class="form-control" name="subtitle_two" value="{{ old('subtitle_two', $feature->subtitle_two) }}">
                                <x-input-error for="subtitle_two" class="mt-2"/>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <x-image-preview src="{{ asset($feature->image_three) }}" style="background-color: #b3b3b3"/>
                                <label class="form-label">Image Three</label>
                                <input type="file" class="form-control" name="image_three">
                                <input type="hidden" name="old_image_three" value="{{ $feature->image_three }}">
                                <x-input-error for="image_three" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title Three</label>
                                <input type="text" class="form-control" name="title_three" value="{{ old('title_three', $feature->title_three) }}">
                                <x-input-error for="title_three" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Subtitle Three</label>
                                <input type="text" class="form-control" name="subtitle_three" value="{{ old('subtitle_three', $feature->subtitle_three) }}">
                                <x-input-error for="subtitle_three" class="mt-2"/>
                            </div>
                        </div>
                        <hr>
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
