@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Footer Contents</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.footer.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control" value="{{ $topBar->description ?? '' }}" placeholder="">
                            <x-input-error for="description" class="mt-2"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="copyright" class="form-label">Copyright</label>
                            <input type="text" name="copyright" class="form-control" value="{{ $topBar->copyright ?? '' }}" placeholder="">
                            <x-input-error for="copyright" class="mt-2"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $topBar->phone ?? '' }}" placeholder="">
                            <x-input-error for="phone" class="mt-2"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $topBar->email ?? '' }}" placeholder="">
                            <x-input-error for="email" class="mt-2"/>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $topBar->address ?? '' }}" placeholder="">
                            <x-input-error for="address" class="mt-2"/>
                        </div>
                    </div>
                    <div class="mb-3">
                       <button class="btn btn-primary" type="submit">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
