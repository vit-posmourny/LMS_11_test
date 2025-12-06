@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Feature Section</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-levels.index') }}" class="btn btn-primary">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
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
                                <input type="file" class="form-control" name="image_one" placeholder="">
                                <input type="hidden" name="old_image_one" value="">
                                <x-input-error for="image_one" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title One</label>
                                <input type="text" class="form-control" name="title_one" value="{{ old('title_one', $feature->title_one) }}" placeholder="">
                                <x-input-error for="title_one" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Subtitle One</label>
                                <input type="text" class="form-control" name="subtitle_one" value="{{ old('subtitle_one', $feature->subtitle_one) }}" placeholder="">
                                <x-input-error for="subtitle_one" class="mt-2"/>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <x-image-preview src="{{ asset($feature->image_two) }}" style="background-color: #b3b3b3"/>
                                <label class="form-label">Image Two</label>
                                <input type="file" class="form-control" name="image_two" placeholder="">
                                <x-input-error for="image_two" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title Two</label>
                                <input type="text" class="form-control" name="title_two" value="{{ old('title_two', $feature->title_two) }}" placeholder="">
                                <x-input-error for="title_two" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Subtitle Two</label>
                                <input type="text" class="form-control" name="subtitle_two" value="{{ old('subtitle_two', $feature->subtitle_two) }}" placeholder="">
                                <x-input-error for="subtitle_two" class="mt-2"/>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <x-image-preview src="{{ asset($feature->image_three) }}" style="background-color: #b3b3b3"/>
                                <label class="form-label">Image Three</label>
                                <input type="file" class="form-control" name="image_three" placeholder="">
                                <x-input-error for="image_three" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title Three</label>
                                <input type="text" class="form-control" name="title_three" value="{{ old('title_three', $feature->title_three) }}" placeholder="">
                                <x-input-error for="title_three" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Subtitle Three</label>
                                <input type="text" class="form-control" name="subtitle_three" value="{{ old('subtitle_three', $feature->subtitle_three) }}" placeholder="">
                                <x-input-error for="subtitle_three" class="mt-2"/>
                            </div>
                        </div>
                        <hr>
                        <div class="my-3 ms-2">
                            <button class="btn btn-primary" type="submit">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
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
