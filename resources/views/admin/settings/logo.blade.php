@extends('admin.settings.layout')

@section('settings-content')
<div class="col-12 col-md-9">
    <form action="{{ route('admin.logo-settings.update') }}" class="d-flex flex-column h-100" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <h3 class="card-title mt-4">Logo Settings</h3>
            <div class="row g-3">
                <div class="col-md-12">
                    <x-image-preview src="{{ asset(config('settings.site_logo')) }}"/>
                    <x-input-file-block label="Site logo" name="site_logo"/>
                </div>
                <div class="col-md-12">
                    <x-image-preview src="{{ asset(config('settings.site_footer_logo')) }}"/>
                    <x-input-file-block label="Site footer logo" name="site_footer_logo"/>
                </div>
                <div class="col-md-12">
                    <x-image-preview src="{{ asset(config('settings.site_favicon')) }}"/>
                    <x-input-file-block label="Site favicon" name="site_favicon"/>
                </div>
                <div class="col-md-12">
                    <x-image-preview src="{{ asset(config('settings.site_breadcrumb')) }}"/>
                    <x-input-file-block label="Site breadcrumb" name="site_breadcrumb"/>
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <a href="#" class="btn btn-1"> Cancel </a>
                <button type="submit" class="btn btn-primary btn-2">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
