{{-- resources\views\admin\course\category\create.blade.php --}}
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Footer Column Two</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.footer-column-two.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.footer-column-two.update', $column->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <x-input-block name="title" :value="$column->title" placeholder="Enter column title"/>
                        </div>
                        <div class="col-md-6">
                            <x-input-block name="url" :value="$column->url" placeholder="Enter URL"/>
                        </div>
                        <div class="col-md-3">
                            <x-input-toggle-block name="status" label="Status" :checked="$column->status == 1"/>
                        </div>
                    </div>

                    <div class="mt-3">
                       <button class="btn btn-primary" type="submit">
                            <x-tabler-icon icon="device-floppy" sprite="outline"/>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
