<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/tabler.min.css') }}"/>
    {{-- pridano kvuli Roboto fontu --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/style.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        @page {
            size: {{ data_get($certificate, 'bg_width', 1024) . 'px' }} {{ data_get($certificate, 'bg_height', 724) . 'px' }};
            margin: 0;
        }

        ._certificate_boundary  {
            position: relative;
            width: {{ data_get($certificate, 'bg_width', 1024) . 'px' }};
            height: {{ data_get($certificate, 'bg_height', 724) . 'px' }};
            background-repeat: no-repeat;
            background-position: center;
            text-align: center;
        }

        ._text_box {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        ._title {
            font-family: "Roboto", sans-serif;
            font-size: 22px;
            font-weight: 500;
            margin: 0.5rem;
        }

        ._subtitle {
            font-family: "Roboto", sans-serif;
            font-size: 14px;
            font-weight: 400;
            margin: 0;
        }

        ._description {
            font-family: "Roboto", sans-serif;
            font-size: 14px;
            font-weight: 400;
            margin-top: 1.5rem;
            color: rgb(120, 120, 130);
        }

        ._signature {
            position: absolute;
            /* margin-top: 0.85rem; */
        }

        ._signature span {
            margin-right: 0.5rem;
        }

        ._signature span, ._signature img {
            font-size: 0.85rem;
            color: rgb(120, 120, 130);
            display: inline-block;
            vertical-align: middle; /* Pro lepší vertikální zarovnání textu s obrázkem */
        }

        ._signature img {
            width: 104px;
            height: {{ data_get($certificate, 'aspectRatioHeight', 66) . 'px' }};
            margin-left: 0.5rem;
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
    <div class="_certificate_boundary" style="background-image: url({{ public_path($certificate->background) }})">
        <div class="_text_box">
            <h1 class="_title">{{ $certificate->title }}</h1>
            <h4 class="_subtitle">{{ $certificate->subtitle }}</h4>
            <p class="_description">{{ $certificate->description }}</p>
        </div>
        <div id="signature" class="_signature _draggable_element" style="
                left: {{ $certificateItem->x_position ?? '43%' }};
                top: {{ $certificateItem->y_position ?? '58%' }};" data-position-saved="{{ $certificateItem->saved ?? 'false' }}">
            <span>signature: </span>
            <img src="{{ public_path($certificate->signature) }}" alt="signature-image">
        </div>
    </div>
    <script src="{{ asset('admin/assets/dist/js/tabler.min.js') }}" defer></script>
</body>
</html>
