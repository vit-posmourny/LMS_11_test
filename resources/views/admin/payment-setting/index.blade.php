<!-- resources\views\admin\payment-setting\index.blade.php -->
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Level</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.payment-setting.index') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M15 6l-6 6l6 6" />
                        </svg>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#paypal-setting" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                                    role="tab">Paypal Settings</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#stripe-setting" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                    role="tab" tabindex="-1">Stripe Settings</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#razorpay-setting" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                    role="tab" tabindex="-1">Razorpay Settings</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="paypal-setting" role="tabpanel">
                                <form action="{{ route('admin.paypal-setting.update') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Paypal Mode</label>
                                                <select name="paypal_mode" class="form-control">
                                                    <option @selected(config('gateway_settings.paypal_mode') === 'sandbox') value="sandbox">Sandbox</option>
                                                    <option @selected(config('gateway_settings.paypal_mode') === 'live') value="live">Live</option>
                                                </select>
                                                <x-input-error for="paypal_mode" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Currency</label>
                                                <select name="paypal_currency" class="form-control select2">
                                                    @foreach (config('gateway_currencies.paypal_currencies') as $key => $currency)
                                                        <option @selected(config('gateway_settings.paypal_currency') === $currency['code']) value="{{ $key }}">{{ $key." — ".$currency['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error for="paypal_currency" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Rate (USD)</label>
                                                <input type="number" class="form-control" name="paypal_rate" value="{{ config('gateway_settings.paypal_rate') }}" placeholder="Enter paypal rate">
                                                <x-input-error for="paypal_rate" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Client ID</label>
                                                <input type="text" class="form-control" name="paypal_client_id" value="{{ config('gateway_settings.paypal_client_id') }}" placeholder="Enter paypal client ID">
                                                <x-input-error for="paypal_client_id" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Client Secret</label>
                                                <input type="text" class="form-control" name="paypal_client_secret" value="{{ config('gateway_settings.paypal_client_secret') }}" placeholder="Enter paypal client secret">
                                                <x-input-error for="paypal_client_secret" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">App ID</label>
                                                <input type="text" class="form-control" name="paypal_app_id" value="{{ config('gateway_settings.paypal_app_id') }}" placeholder="Enter paypal app ID">
                                                <x-input-error for="paypal_app_id" class="mt-2"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="stripe-setting" role="tabpanel">
                                <form action="{{ route('admin.stripe-setting.update') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Stripe Status</label>
                                                <select name="stripe_status" class="form-control">
                                                    <option @selected(config('gateway_settings.stripe_status') === 'active') value="active">Active</option>
                                                    <option @selected(config('gateway_settings.stripe_status') === 'inactive') value="inactive">Inactive</option>
                                                </select>
                                                <x-input-error for="stripe_status" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Currency</label>
                                                <select name="stripe_currency" class="form-control select2">
                                                    @foreach (config('gateway_currencies.stripe_currencies') as $key => $currency)
                                                        <option @selected(config('gateway_settings.stripe_currency') === $currency) value="{{ $currency }}">{{ $currency }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error for="stripe_currency" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Rate (USD)</label>
                                                <input type="number" class="form-control" name="stripe_rate" value="{{ config('gateway_settings.stripe_rate') }}" placeholder="Enter stripe rate">
                                                <x-input-error for="stripe_rate" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Publishable Key</label>
                                                <input type="text" class="form-control" name="stripe_publishable_key" value="{{ config('gateway_settings.stripe_publishable_key') }}" placeholder="Enter stripe publishable key">
                                                <x-input-error for="stripe_publishable_key" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Secret Key</label>
                                                <input type="text" class="form-control" name="stripe_secret_key" value="{{ config('gateway_settings.stripe_secret_key') }}" placeholder="Enter stripe client secret key">
                                                <x-input-error for="stripe_secret_key" class="mt-2"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="razorpay-setting" role="tabpanel">
                                <form action="{{ route('admin.razorpay-setting.update') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Razorpay Status</label>
                                                <select name="razorpay_status" class="form-control">
                                                    <option @selected(config('gateway_settings.razorpay_status') === 'active') value="active">Active</option>
                                                    <option @selected(config('gateway_settings.razorpay_status') === 'inactive') value="inactive">Inactive</option>
                                                </select>
                                                <x-input-error for="razorpay_status" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Currency</label>
                                                <select name="razorpay_currency" class="form-control select2">
                                                    @foreach (config('gateway_currencies.razorpay_currencies') as $key => $currency)
                                                        <option @selected(config('gateway_settings.razorpay_currency') === $currency) value="{{ $currency }}">{{ $currency }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error for="razorpay_currency" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Rate (USD)</label>
                                                <input type="number" class="form-control" name="razorpay_rate" value="{{ config('gateway_settings.razorpay_rate') }}" placeholder="Enter razorpay rate">
                                                <x-input-error for="razorpay_rate" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Publishable Key</label>
                                                <input type="text" class="form-control" name="razorpay_key" value="{{ config('gateway_settings.razorpay_key') }}" placeholder="Enter razorpay key">
                                                <x-input-error for="razorpay_key" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Secret Key</label>
                                                <input type="text" class="form-control" name="razorpay_secret" value="{{ config('gateway_settings.razorpay_secret') }}" placeholder="Enter razorpay client secret">
                                                <x-input-error for="razorpay_secret" class="mt-2"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
