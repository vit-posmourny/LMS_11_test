@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog-categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <x-input-block name="name"  class="@error('name') is-invalid @enderror" :value="old('name', $category->name)" placeholder="Enter category name"/>
                            <div class="row">
                                <div class="col-md-3">
                                    <x-input-toggle-block name="status" label="Status" :checked="old('status', $category->status == 1)"/>
                                </div>
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
