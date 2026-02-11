@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Top Bar</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.top-bar.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $topBar->email ?? '' }}" placeholder="">
                            <x-input-error for="email" class="mt-2"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $topBar->phone ?? '' }}" placeholder="">
                            <x-input-error for="phone" class="mt-2"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="offer_name" class="form-label">Offer Name</label>
                            <input type="text" name="offer_name" class="form-control" value="{{ $topBar->offer_name ?? '' }}" placeholder="">
                            <x-input-error for="offer_name" class="mt-2"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="offer_short_description" class="form-label">Offer Short Description</label>
                            <input type="text" name="offer_short_description" class="form-control" value="{{ $topBar->offer_short_description ?? '' }}" placeholder="">
                            <x-input-error for="offer_short_description" class="mt-2"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="offer_button_text" class="form-label">Offer Button Text</label>
                            <input type="text" name="offer_button_text" class="form-control" value="{{ $topBar->offer_button_text ?? '' }}" placeholder="">
                            <x-input-error for="offer_button_text" class="mt-2"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="offer_button_url" class="form-label">Offer Button URL</label>
                            <input type="text" name="offer_button_url" class="form-control" value="{{ $topBar->offer_button_url ?? '' }}" placeholder="">
                            <x-input-error for="offer_button_url" class="mt-2"/>
                        </div>
                    </div>
                    <div class="mb-3">
                       <button class="btn btn-primary" type="submit">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
