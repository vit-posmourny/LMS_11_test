@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Latest Course Section</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-levels.index') }}" class="btn btn-primary">
                        <x-tabler-icon icon="chevron-left" style="stroke-width: 2" class="icon-tabler" sprite="outline"/>
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
                                <select id="category_one" class="form-select is-tom-select" name="category_one">
                                    <option value=""> Please Select </option>
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option @selected($latestCourseSection->category_one == $subCategory->id) value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
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
                                <select id="category_two" class="form-select is-tom-select" name="category_two">
                                    <option value=""> Please Select </option>
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option @selected($latestCourseSection->category_two == $subCategory->id) value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
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
                                <select id="category_three" class="form-select is-tom-select" name="category_three">
                                    <option value=""> Please Select </option>
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option @selected($latestCourseSection->category_three == $subCategory->id) value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
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
                                <select id="category_four" class="form-select is-tom-select" name="category_four">
                                    <option value=""> Please Select </option>
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option @selected($latestCourseSection->category_four == $subCategory->id) value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
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
                                <select id="category_five" class="form-select is-tom-select" name="category_five">
                                    <option value=""> Please Select </option>
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option @selected($latestCourseSection->category_five == $subCategory->id) value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
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

@push('header_styles')
    @vite('resources/css/tom-select.css')
@endpush
@push('scripts')
    @vite('resources/js/tom-select-ini.js')
@endpush
