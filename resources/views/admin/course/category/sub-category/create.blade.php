{{-- resources\views\admin\course\category\create.blade.php --}}
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Category</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-categories.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sub-categories.store', $course_category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <x-input-file-block name="image"/>
                        </div>
                        <div class="col-md-6">
                            <x-input-block name="icon" placeholder="Enter icon class name">
                                <x-slot name="hint">
                                    <small class="hint">You can get icon classes from: <a target="__blank" href="https://tabler.io/icons">https://tabler.io/icons</a></small>
                                </x-slot>
                            </x-input-block>
                        </div>
                        <div class="col-md-12">
                            <x-input-block name="name" placeholder="Enter category name"/>
                        </div>
                        <div class="col-md-3">
                            <x-input-toggle-block name="show_at_trending" label="Show at trending"/>
                        </div>
                        <div class="col-md-3">
                            <x-input-toggle-block name="status" label="Status"/>
                        </div>
                    </div>

                    <div class="mt-3">
                       <button class="btn btn-primary" type="submit">
                            <x-tabler-icon icon="device-floppy" class="icon-tabler" sprite="outline"/>
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
