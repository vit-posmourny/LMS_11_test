<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/tabler.min.css') }}"/>
    {{-- pridano kvuli Roboto fontu --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/style.css') }}">
    <style>
        ._certificate_body  {
            position: relative;
            width: 54.1%;
            height: 80%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        ._text_box {
            position: absolute;
            text-align: center;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
        <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>
<body>
    <div class="_certificate_body" style="background-image: url({{ asset($certificate->background) }})">
        <div class="_certificate_boundary w-full h-full ps-7 pe-8 py-8" style="position: absolute">
            <div class="_text_box">
                <h1>{{ $certificate->title }}</h1>
                <h4>{{ $certificate->subtitle }}</h4>
                <p class="pt-3">{{ $certificate->description }}</p>
            </div>
            {{-- pres css se to nechytalo, proto inline styles --}}
            <div id="signature" class="d-flex flex-row align-items-center gap-3 _draggable_element" style="
                    position: absolute;
                    text-align: center;
                    width: 10%;
                    left: {{ $certificateItem->x_position ?? '43%' }};
                    top: {{ $certificateItem->y_position ?? '58%' }};" data-position-saved="{{ $certificateItem->saved ?? 'false' }}">
                <span>signature: </span>
                <img src="{{ asset($certificate->signature) }}" alt="signature-image">
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/dist/js/tabler.min.js') }}" defer></script>
</body>
</html>
