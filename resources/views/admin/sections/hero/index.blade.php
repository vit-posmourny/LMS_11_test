@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Hero Section</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-levels.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Label</label>
                                <input type="text" class="form-control" name="label" value="{{ $hero->label }}" placeholder="">
                                <x-input-error for="label" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $hero->title }}" placeholder="">
                                <x-input-error for="title" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Subtitle</label>
                                <input type="text" class="form-control" name="subtitle" value="{{ $hero->subtitle }}" placeholder="">
                                <x-input-error for="subtitle" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Button Text</label>
                                <input type="text" class="form-control" name="button_text" value="{{ $hero->button_text }}" placeholder="">
                                <x-input-error for="button_text" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Button Url</label>
                                <input type="text" class="form-control" name="button_url" value="{{ $hero->button_url }}" placeholder="">
                                <x-input-error for="button_url" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Video Button Text</label>
                                <input type="text" class="form-control" name="video_button_text" value="{{ $hero->video_button_text }}" placeholder="">
                                <x-input-error for="video_button_text" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Video Button Url</label>
                                <input type="text" class="form-control" name="video_button_url" value="{{ $hero->button_url }}" placeholder="">
                                <x-input-error for="video_button_url" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Banner Item Title</label>
                                <input type="text" class="form-control" name="banner_item_title" value="{{ $hero->banner_item_title }}" placeholder="">
                                <x-input-error for="banner_item_title" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Banner Item Subtitle</label>
                                <input type="text" class="form-control" name="banner_item_subtitle" value="{{ $hero->banner_item_subtitle }}" placeholder="">
                                <x-input-error for="banner_item_subtitle" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Rounded Text</label>
                                <input type="text" class="form-control" name="rounded_text" value="{{ $hero->rounded_text }}" placeholder="">
                                <x-input-error for="rounded_text" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <x-image-preview src="{{ asset($hero->hero_image) }}"/>
                                <label class="form-label">Hero Image</label>
                                <input type="file" class="form-control" name="hero_image" placeholder="">
                                <x-input-error for="hero_image" class="mt-2"/>
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
