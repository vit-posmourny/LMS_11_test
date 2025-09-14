{{-- resources\views\frontend\instructor-dashboard\profile\index.blade.php --}}
@extends('frontend.layouts.master')

@section('content')
    <!--===========================
            BREADCRUMB START
    ============================-->
    <section class="wsus__breadcrumb" style="background: url({{ asset('frontend/assets/images/breadcrumb_bg.jpg') }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Instructor Dashboard</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Instructor Dashboard / Instructor Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
            BREADCRUMB END
    ============================-->


    <!--===========================
            DASHBOARD OVERVIEW START
    ============================-->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('frontend.instructor-dashboard.sidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Information</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>

                        <form action="{{ route('instructor.profile.update') }}" method="POST"
                            class="wsus__dashboard_profile_update" enctype="multipart/form-data">
                            @csrf

                            <div class="wsus__dashboard_profile wsus__dashboard_profile_avatar">
                                <div class="img">
                                    <img src="{{ asset(auth()->user()->avatar) }}" alt="profile" class="img-fluid w-100">
                                    <label for="profile_photo">
                                        <img src="{{ asset('frontend/assets/images/dash_camera.png') }}" alt="camera"
                                            class="img-fluid w-100">
                                    </label>
                                    <input type="file" id="profile_photo" name="avatar" hidden="">
                                </div>
                                <div class="text">
                                    <h6>Your avatar</h6>
                                    <p>PNG or JPG no bigger than 400px wide and tall.</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Your Name</label>
                                        <input type="text" name="name" value="{{ auth()->user()->name }}"
                                            placeholder="Enter your full name">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Headline</label>
                                        <input type="text" name="headline" value="{{ auth()->user()->headline }}"
                                            placeholder="Enter your headline">
                                        <x-input-error :messages="$errors->get('headline')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Your E-mail</label>
                                        <input type="text" name="email" value="{{ auth()->user()->email }}"
                                            placeholder="Enter your e-mail">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Your Gender</label>
                                        <select name="gender" name="gender" class="form-control">
                                            <option value="">Select</option>
                                            <option @selected(auth()->user()->gender == 'male') value="male">Male</option>
                                            <option @selected(auth()->user()->gender == 'female') value="female">Female</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>About Me</label>
                                        <textarea class="form-control" rows="7" name="bio" placeholder="Your text here">{{ auth()->user()->bio }}</textarea>
                                        <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Payout Settings</h5>
                                <p>Put your payout information here.</p>
                            </div>
                        </div>
                        <form action="{{ route('instructor.profile.update-gateway-info') }}" method="POST"
                            class="wsus__dashboard_profile_update">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        @foreach ($gateways as $gateway)
                                            <span class="d-none gateway-{{ $gateway->id }}">{!! $gateway->description !!}</span>
                                        @endforeach
                                        <label class="form-label">Gateway</label>
                                        <select name="gateway_name" class="form-select gateway">
                                            <option value="">Select</option>
                                            @foreach ($gateways as $gateway)
                                                <option @selected(user()?->gatewayInfo?->gateway === $gateway->name) value="{{ $gateway->name }}" data-gateway="{{ $gateway->id }}">
                                                    {{ $gateway->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('gateway_name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label class="form-label">Gateway Description</label>
                                        <textarea class="gateway__description form-control" name="gateway_info" style="height: 300px;" readonly>{!! user()?->gatewayInfo?->information !!}</textarea>
                                        <x-input-error :messages="$errors->get('gateway_info')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Payout Settings</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Password</h5>
                                <p>Add your new email or password here to update.</p>
                            </div>
                        </div>

                        <form action="{{ route('instructor.profile.update-password') }}" method="POST"
                            class="wsus__dashboard_profile_update">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password"
                                            placeholder="Enter your current password">
                                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>New Password</label>
                                        <input type="password" name="new_password" placeholder="Enter your new password">
                                        <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirm"
                                            placeholder="Enter your new password again">
                                        <x-input-error :messages="$errors->get('password_confirm')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Social Information</h5>
                                <p>Put your social links here.</p>
                            </div>
                        </div>

                        <form action="{{ route('instructor.profile.update-social') }}" method="POST"
                            class="wsus__dashboard_profile_update">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Facebook</label>
                                        <input type="text" name="facebook" placeholder="Enter your facebook url">
                                        <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>X</label>
                                        <input type="text" name="x" placeholder="Enter your x url">
                                        <x-input-error :messages="$errors->get('x')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>LinkedIn</label>
                                        <input type="text" name="linkedin" placeholder="Enter your linkedin url">
                                        <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Website</label>
                                        <input type="text" name="website" placeholder="Enter your website url">
                                        <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__dashboard_profile_update_btn">
                                            <button type="submit" class="common_btn">Update Socials</button>
                                        </div>
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
            DASHBOARD OVERVIEW END
    ============================-->
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.gateway').on('change', function() {
                let id = $(this).find(':selected').data('gateway');
                $('.gateway__description').val($('.gateway-'+id).html());
                //$('.gateway__description').attr('placeholder' ,$('.gateway-'+id).html());
            })
        });
    </script>
@endpush
