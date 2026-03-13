{{-- resources\views\admin\course\category\edit.blade.php --}}
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Sub-Category</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-categories.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sub-categories.update', ['course_category' => $course_category->id, 'course_sub_category' => $course_sub_category->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @if ($course_sub_category->image)
                            <x-image-preview src="{{ asset($course_sub_category->image) }}"/>
                        @endif

                        <div class="col-md-6">
                            <x-input-file-block name="image"/>
                        </div>
                        <div class="col-md-6">
                            <x-input-block name="icon" :value="$course_sub_category->icon" placeholder="Enter icon class name">
                                <x-slot name="hint">
                                    <small class="hint">You can get icon classes from: <a target="__blank" href="https://tabler.io/icons">https://tabler.io/icons</a></small>
                                </x-slot>
                            </x-input-block>
                        </div>
                        <div class="col-md-12">
                            <x-input-block name="name" :value="$course_sub_category->name"/>
                        </div>
                        <div class="col-md-3">
                            <x-input-toggle-block name="show_at_trending" label="Show at trending" :checked="$course_sub_category->show_at_trending"/>
                        </div>
                        <div class="col-md-3">
                            <x-input-toggle-block name="status" label="Status" :checked="$course_sub_category->status"/>
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
