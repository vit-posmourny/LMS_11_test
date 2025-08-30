@extends('admin.settings.layout')

@section('settings-content')
<div class="col-12 col-md-9 d-flex flex-column">
    <form action="{{ route('admin.main-settings.update') }}" method="POST">
        @csrf
        <div class="card-body">
            <h3 class="card-title mt-4">Main Settings</h3>
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="form-label">Site Name</div>
                    <input type="text" class="form-control" name="site_name" value="{{ config('settings.site_name') }}">
                    <x-input-error :messages="$errors->get('site_name')" class="mt-2" />
                </div>
                <div class="col-md-6">
                    <div class="form-label">Phone Number</div>
                    <input type="tel" class="form-control" name="phone_number"
                        pattern="+[0-9]{3} [0-9]{3} [0-9]{3} " value="{{ config('settings.phone_number') }}">
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>
                <div class="col-md-6">
                    <div class="form-label">Location</div>
                    <input type="text" class="form-control" name="location" value="{{ config('settings.location') }}">
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

                <div class="col-md-6">
                    <div class="form-label">Site Default Currency</div>
                    <select id="" class="form-control select2" name="default_currency" value="{{ config('settings.default_currency') }}">
                        <option value="">Select</option>
                        @foreach (config('gateway_currencies.all_currencies') as $value)
                            <option @selected(config('settings.default_currency') === $value) value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="form-label">Currency Icon</div>
                    <input type="text" class="form-control" name="currency_icon" value="{{ config('settings.currency_icon') }}">
                    <x-input-error :messages="$errors->get('currency_icon')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <a href="#" class="btn btn-1"> Cancel </a>
                <button type="submit" class="btn btn-primary btn-2">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
