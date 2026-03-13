<!-- resources\views\admin\sections\counter\index.blade.php -->
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Counter</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.counter-section.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Counter One</label>
                                <input type="text" class="form-control" name="counter_one" value="{{ $counter->counter_one }}">
                                <x-input-error for="counter_one" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title One</label>
                                <input type="text" class="form-control" name="title_one" value="{{ $counter->title_one }}">
                                <x-input-error for="title_one" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Counter Two</label>
                                <input type="text" class="form-control" name="counter_two" value="{{ $counter->counter_two }}">
                                <x-input-error for="counter_two" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title Two</label>
                                <input type="text" class="form-control" name="title_two" value="{{ $counter->title_two }}">
                                <x-input-error for="title_two" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Counter Three</label>
                                <input type="text" class="form-control" name="counter_three" value="{{ $counter->counter_three }}">
                                <x-input-error for="counter_three" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title Three</label>
                                <input type="text" class="form-control" name="title_three" value="{{ $counter->title_three }}">
                                <x-input-error for="title_three" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Counter Four</label>
                                <input type="text" class="form-control" name="counter four" value="{{ $counter->counter_four }}">
                                <x-input-error for="counter four" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title Four</label>
                                <input type="text" class="form-control" name="title four" value="{{ $counter->title_four }}">
                                <x-input-error for="title four" class="mt-2"/>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">
                                <x-tabler-icon icon="device-floppy" class="icon-tabler" sprite="outline"/>
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
