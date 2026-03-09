@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Custom Page</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.custom-page.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.custom-page.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <x-input-block name="title" placeholder="Enter page title"/>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="editor" name="description" placeholder="Enter page description"></textarea>
                                <x-input-error for="description" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <x-input-block label="SEO Title" name="seo_title" placeholder="Enter SEO title"/>

                            <label for="seo_description" class="form-label mt-3">SEO Description</label>
                            <textarea name="seo_description" placeholder="Enter SEO description"></textarea>
                            <x-input-error for="seo_description" class="mt-2"/>

                            <div class="row mt-2">
                                <div class="col-6">
                                    <x-input-toggle-block name="status" label="Status"/>
                                </div>
                                <div class="col-6">
                                    <x-input-toggle-block name="show_at_nav" label="Show at Navigation"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                       <button class="btn btn-primary" type="submit">
                            <x-tabler-icon icon="device-floppy" sprite="outline"/>
                            Create
                        </button>
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
    @vite(['resources/js/admin/tinymce-init.js'])
@endpush
