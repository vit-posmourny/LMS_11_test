@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Social Link</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.social-links.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.social-links.update', $socialLink->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <x-tabler-icon icon="{{ $socialLink->icon }}" class="mb-3" width="3rem" height="4rem"/>
                            <x-input-block name="icon" value="{{ $socialLink->icon }}"/>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <x-input-block name="url" value="{{ $socialLink->url }}" placeholder="Enter social link URL"/>
                        </div>
                        <div class="col-md-3">
                            <x-input-toggle-block name="status" label="Status" :checked="$socialLink->status == 1"/>
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
