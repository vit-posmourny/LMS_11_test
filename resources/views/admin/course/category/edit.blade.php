{{-- resources\views\admin\course\category\edit.blade.php --}}
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Category</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-categories.index') }}" class="btn btn-primary">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.course-categories.update', $course_category) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <x-image-preview src="{{ asset($course_category->image) }}"/>

                        <div class="col-md-6">
                            <x-input-file-block name="image"/>
                        </div>
                        <div class="col-md-6">
                            <x-input-block name="icon" :value="$course_category->icon" placeholder="Enter icon class name">
                                <x-slot name="hint">
                                    <small class="hint">You can get icon classes from: <a target="__blank" href="https://tabler.io/icons">https://tabler.io/icons</a></small>
                                </x-slot>
                            </x-input-block>
                        </div>
                        <div class="col-md-12">
                            <x-input-block name="name" :value="$course_category->name"/>
                        </div>
                        <div class="col-md-3">
                            <x-input-toggle-block name="show_at_trending" label="Show at trending" :checked="$course_category->show_at_trending"/>
                        </div>
                        <div class="col-md-3">
                            <x-input-toggle-block name="status" label="Status" :checked="$course_category->status"/>
                        </div>
                    </div>

                    <div class="mt-3">
                       <button class="btn btn-primary" type="submit">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
