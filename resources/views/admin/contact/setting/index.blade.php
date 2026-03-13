@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contact Setting</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.contact-setting.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contact-setting.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <x-image-preview src="{{ asset($contactSetting->image) }}" style="background-color: #b3b3b3"/>
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                        <x-input-error for="image" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Map Url</label>
                        <input type="text" class="form-control" name="map_url" value="{{ $contactSetting->map_url }}">
                        <x-input-error for="map_url" class="mt-2"/>
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
