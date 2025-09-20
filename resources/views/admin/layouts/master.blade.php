<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="base_url" content="{{ url('') }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    {{-- css plugins --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css"/>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('public/fontawesome-free-7.0.1-web/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/fontawesome-free-7.0.1-web/css/solid.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- CSS files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/tabler.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/demo.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/nice-select.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/style.css') }}">

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    @vite(['resources/css/admin.css', 'resources/js/admin/admin.js', 'resources/css/frontend.css', 'resources/css/global.css'])
    @stack('header_scripts')
</head>

<body>
    <script src="{{ asset('admin/assets/dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- Navbar -->
        @include('admin.layouts.header')

        <div class="page-wrapper">
            <!-- Main Content -->
            @yield('content')
            <!-- Footer -->
            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z">
                        </path>
                        <path d="M12 9v4"></path>
                        <path d="M12 17h.01"></path>
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-secondary">Do you really want to remove these files? What you've done cannot be undone.
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Cancel
                                </a></div>
                            <div class="col"><a href="#" class="btn btn-danger delete-confirm w-100">
                                    Delete
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="id__dynamic__modal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg dynamic__modal__content">

        </div>
    </div>

    <!--jquery library js-->
    <script src="{{ asset('frontend/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!--font-awesome js-->
    {{-- <script src="{{ asset('admin/assets/dist/js/Font-Awesome.js') }}"></script> --}}
    <script src="{{ asset('fontawesome-free-7.0.1-web/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('fontawesome-free-7.0.1-web/js/solid.min.js') }}"></script>
    {{-- select2.min.js --}}
    <script defer src={{ asset('frontend/assets/js/select2.min.js') }}></script>
    <!-- Libs JS -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <!-- Tabler Core -->
    <script src="{{ asset('admin/assets/dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('admin/assets/dist/js/demo.min.js') }}" defer></script>
    {{-- jQuery Core --}}
    <script src="{{ asset('admin/assets/dist/js/jquery.nice-select.min.js') }}" defer></script>
    {{-- jquery ui --}}
    <script src="{{ asset('/frontend/assets/js/jquery-ui.min.js') }}" defer></script>
    {{-- 3rd party plugins --}}
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js" defer></script>

    {{-- dynamic js --}}
    @stack('scripts')
</body>
</html>
