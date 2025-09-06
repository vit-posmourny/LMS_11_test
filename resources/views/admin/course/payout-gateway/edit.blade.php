@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Payout Gateway</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.payout-gateway.index') }}" class="btn btn-primary">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
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
                        <x-input-error :messages ="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" style="height: 300px">{!! $payout_gateway->description !!}</textarea>
                        <x-input-error :messages ="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option @selected($payout_gateway->status === 1) value="1" class="form-option">Active</option>
                            <option @selected($payout_gateway->status === 0) value="0">Inactive</option>
                        </select>
                        <x-input-error :messages ="$errors->get('status')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                       <button class="btn btn-primary" type="submit">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
