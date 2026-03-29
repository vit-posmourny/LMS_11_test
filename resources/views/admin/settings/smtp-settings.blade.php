@extends('admin.settings.layout')

@section('settings-content')
<div class="col-12 col-md-9">
    <form action="{{ route('admin.smtp-settings.update') }}" class="d-flex flex-column h-100" method="POST">
        @csrf
        <div class="card-body">
            <h3 class="card-title mt-4">SMTP Settings</h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-label">Sender Email</div>
                    <input type="text" class="form-control" name="sender_email" value="{{ config('settings.sender_email') }}">
                    <x-input-error for="sender_email" class="mt-2"/>
                </div>
                <div class="col-md-6">
                    <div class="form-label">Receiver Email</div>
                    <input type="text" class="form-control" name="receiver_email" value="{{ config('settings.receiver_email') }}">
                    <x-input-error for="receiver_email" class="mt-2"/>
                </div>
                <div class="col-md-6">
                    <div class="form-label">Mailer</div>
                    <input type="text" class="form-control" name="mail_mailer" value="{{ config('settings.mail_mailer') }}">
                    <x-input-error for="mail_mailer" class="mt-2"/>
                </div>
                <div class="col-md-6">
                    <div class="form-label">Host</div>
                    <input type="text" class="form-control" name="mail_host" value="{{ config('settings.mail_host') }}">
                    <x-input-error for="mail_host" class="mt-2"/>
                </div>
                <div class="col-md-6">
                    <div class="form-label">Port</div>
                    <input type="text" class="form-control" name="mail_port" value="{{ config('settings.mail_port') }}">
                    <x-input-error for="mail_port" class="mt-2"/>
                </div>
                <div class="col-md-6">
                    <div class="form-label">User Name</div>
                    <input type="text" class="form-control" name="mail_username" value="{{ config('settings.mail_username') }}">
                    <x-input-error for="mail_username" class="mt-2"/>
                </div>
                <div class="col-md-6">
                    <div class="form-label">Password</div>
                    <input type="password" class="form-control" name="mail_password" value="{{ config('settings.mail_password') }}">
                    <x-input-error for="mail_password" class="mt-2"/>
                </div>
                <div class="col-md-6">
                    <div class="form-label">Mail Encryption</div>
                    <input type="text" class="form-control" name="mail_encryption" value="{{ config('settings.mail_encryption') }}">
                    <x-input-error for="mail_encryption" class="mt-2"/>
                </div>
                <div class="col-md-2">
                    <div class="form-label">Mail Queue</div>
                    <select class="form-select" name="mail_queue" id="">
                        <option value="true" @selected(config('settings.mail_queue') == 'true')>On</option>
                        <option value="false" @selected(config('settings.mail_queue') == 'false')>Off</option>
                    </select>
                    <x-input-error for="mail_queue" class="mt-2"/>
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
