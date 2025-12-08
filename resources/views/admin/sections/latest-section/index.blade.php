@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Latest Course Section</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-levels.index') }}" class="btn btn-primary">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.latest-courses-section.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="category_one" class="form-label">Category One</label>
                                <select class="form-select" name="category_one">
                                    <option value=""> Please Select </option>
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error for="category_one" class="mt-2"/>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="category_two" class="form-label">Category Two</label>
                                <select class="form-select" name="category_two">
                                    <option value=""> Please Select </option>
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error for="category_two" class="mt-2"/>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="category_three" class="form-label">Category Three</label>
                                <select class="form-select" name="category_three">
                                    <option value=""> Please Select </option>
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error for="category_three" class="mt-2"/>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="category_four" class="form-label">Category Four</label>
                                <select class="form-select" name="category_four">
                                    <option value=""> Please Select </option>
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error for="category_four" class="mt-2"/>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="category_five" class="form-label">Category Five</label>
                                <select class="form-select" name="category_five">
                                    <option value=""> Please Select </option>
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error for="category_five" class="mt-2"/>
                            </div>
                        </div>
                        <br>
                        <div class="my-3 ms-2">
                            <button class="btn btn-primary" type="submit">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
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
