@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Blog</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <x-image-preview src="{{ asset($blog->image) }}"/>

                            <x-input-file-block name="image" placeholder="Upload blog image"/>

                            <x-input-block name="title" :value="$blog->title" placeholder="Enter blog title"/>

                            <div class="form-group mb-3">
                                <label for="" class="form-label">Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected($blog->blog_category_id == $category->id)>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="description" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="editor">{!! $blog->description !!}</textarea>
                            <x-input-error for="description" class="mt-2"/>
                        </div>
                        <div class="row">
                            <div class="col-3 mt-3">
                                <x-input-toggle-block name="status" :checked="$blog->status" label="Status"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
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
@push('header_scripts')
    <script src="https://cdn.tiny.cloud/1/jkx2gs8cwid6kn4mbyrcm88yn6h065ohcto5zckgsisdztl8/tinymce/8/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>
@endpush
@push('scripts')
    @vite(['resources/js/admin/tinymce-init.js'])
@endpush
