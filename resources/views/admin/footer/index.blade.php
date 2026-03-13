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
                            <x-tabler-icon icon="device-floppy" class="icon-tabler" sprite="outline"/>
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
