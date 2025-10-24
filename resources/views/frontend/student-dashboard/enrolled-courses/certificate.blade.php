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
            margin: 0 auto;
            background-repeat: no-repeat;
            background-position: center;
            width: {{ data_get($certificate, 'bg_width', 1024) . 'px' }};
            height: {{ data_get($certificate, 'bg_height', 724) . 'px' }};
        }

        ._certificate_boundary div, mh1, mh4 {


        }

        ._text_box {
            position: absolute;
            padding-left: 25%;
            padding-right: 25%;
        }

        ._title {
            font-size: 22px;
            transform: translateX(-0.5rem)
        }

        ._subtitle {
            position: absolute;
            font-size: 14px;
            font-weight: 400;
            transform: translateX(-1.5rem)
        }

        ._description {
            font-size: 14px;
            font-weight: 400;
            color: rgb(120, 120, 130);
            transform: translateY(-0.8rem);
            text-align: center;
        }

        ._signature {
            position: absolute;
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
        @foreach ($certificateItems as $item)
            #{{ $item->element_id }} {
                left: {{ $item->x_position }};
                top: {{ $item->y_position }};
                position: relative;
            }
        @endforeach
    </style>
    <style>

    </style>
</head>
<body>
    <div class="_certificate_boundary" style="background-image: url({{ public_path($certificate->background) }})">
        <div class="_text_box">
            <mh1 id="title" class="_title _draggable_element">{{ @$certificate->title }}</mh1>
            <mh4 id="subtitle" class="_subtitle _draggable_element">{{ @$certificate->subtitle }}</mh4>
            <p id="description" class="_description _draggable_element">{{ @$certificate->description }}</p>
        </div>
        <div id="signature" class="_signature _draggable_element">
            <span>signature: </span>
            <img src="{{ public_path($certificate->signature) }}" alt="signature-image">
        </div>
    </div>
    <script src="{{ asset('admin/assets/dist/js/tabler.min.js') }}" defer></script>
</body>
</html>
