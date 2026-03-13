@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Payout Gateway</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.payout-gateway.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.payout-gateway.update' , $payout_gateway) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter level name" value="{{ $payout_gateway->name }}">
                        <x-input-error for="name" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" style="height: 300px">{!! $payout_gateway->description !!}</textarea>
                        <x-input-error for="description" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option @selected($payout_gateway->status === 1) value="1" class="form-option">Active</option>
                            <option @selected($payout_gateway->status === 0) value="0">Inactive</option>
                        </select>
                        <x-input-error for="status" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                       <button class="btn btn-primary" type="submit">
                            <x-tabler-icon icon="device-floppy" class="icon-tabler" sprite="outline"/>
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
