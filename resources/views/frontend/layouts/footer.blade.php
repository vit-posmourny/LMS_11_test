@php
    $footer = App\Models\Footer::first();
    $socialLinks = App\Models\SocialLink::where('status', 1)->get();
    $columnOne = App\Models\FooterColumnOne::where('status', 1)->get();
    $columnTwo = App\Models\FooterColumnTwo::where('status', 1)->get();
@endphp
<footer class="footer_3" style="background: url({{ Vite::asset('resources/images/footer_3_bg.jpg') }};">
    <div class="footer_3_overlay pt_120 xs_pt_100">
        <div class="wsus__footer_bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 wow fadeInUp">
                        <div class="wsus__footer_3_logo_area">
                            <a class="logo" href="index.html">
                                <img src="{{ asset(config('settings.site_footer_logo')) }}" alt="EduCore" class="img-fluid">
                            </a>
                            <p>{{ $footer->description }}</p>
                            <h2>Follow Us On</h2>
                            <ul class="d-flex flex-wrap">
                                @foreach ($socialLinks as $socialLink)
                                <li>
                                    <a href="{{ $socialLink->url }}" target="_blank">
                                        <x-tabler-icon icon="{{ $socialLink->icon }}" class="icon-tabler-social"/>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-3 wow fadeInUp">
                        <div class="wsus__footer_link">
                            <h2>Help Links</h2>
                            <ul>
                                @foreach ($columnOne as $column)
                                    <li><a href="{{ $column->url }}" target="_blank">{{ $column->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-3 wow fadeInUp">
                        <div class="wsus__footer_link">
                            <h2>Programs</h2>
                            <ul>
                                @foreach ($columnTwo as $column)
                                    <li><a href="{{ $column->url }}" target="_blank">{{ $column->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp">
                        <div class="wsus__footer_3_subscribe">
                            <h3>Subscribe Our Newsletter</h3>
                            <form action="#">
                                <input type="text" placeholder="Enter Your Email">
                                <button type="submit" class="common_btn">Subscribe</button>
                            </form>
                            <ul>
                                <li>
                                    <div class="icon">
                                        <img src="{{ Vite::asset('resources/images/call_icon_white.png') }}" alt="Call" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h4>Call us:</h4>
                                        <a href="tel:{{ $footer->phone }}">{{ $footer->phone }}</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="{{ Vite::asset('resources/images/mail_icon_white.png') }}" alt="Email" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h4>Email us:</h4>
                                        <a href="mailto:{{ $footer->email }}">{{ $footer->email }}</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="{{ Vite::asset('resources/images/location_icon_white.png') }}" alt="Call" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h4>Office:</h4>
                                        <p>{{ $footer->address }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wsus__footer_copyright_area mt_140 xs_mt_100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__footer_copyright_text">
                            <p>{{ $footer->copyright }}</p>
                            <ul>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Term of Service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
