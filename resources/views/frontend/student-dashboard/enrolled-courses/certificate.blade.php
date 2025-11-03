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
    </style>
    <style>
        ._certificate_boundary  {
            position: relative;
            width: {{ data_get($certificate, 'bg_width', 1024) . 'px' }};
            height: {{ data_get($certificate, 'bg_height', 724) . 'px' }};
            background-repeat: no-repeat;
            background-position: center;
        }

        ._title, ._subtitle {
            position: absolute;               /* zachová top z DB */
            left: 12%;                        /* místo paddingu kontejneru */
            width: calc(100% - 24%);          /* 100% minus 2 * 18% */
            text-align: center;               /* vystředí text horizontálně v rámci šířky */
            display: block;
            overflow: visible;
        }

        ._description {
            position: absolute;               /* zachová top z DB */
            left: 18%;                        /* místo paddingu kontejneru */
            width: calc(100% - 36%);          /* 100% minus 2 * 18% */
            text-align: center;               /* vystředí text horizontálně v rámci šířky */
            display: block;
            overflow: visible;                /* začíná u levého okraje kontejneru */
        }

        #signature {
            position: absolute;
            width: 100%;
            font-size: 0.85rem;
            color: rgb(120, 120, 130);
        }

        ._signature span {
            margin-right: 0.5rem;
        }

        ._signature span, ._signature img {
            display: inline-block;
            vertical-align: middle; /* Pro lepší vertikální zarovnání textu s obrázkem */
        }

        ._signature img {
            width: 104px;
            height: {{ data_get($certificate, 'aspectRatioHeight', 66) . 'px' }};
            margin-left: 0.5rem;
        }

        /* výška (top) pro každou položku nastavíme z DB - bez leftu */
        @foreach ($certificateItems as $item)
            #{{ $item->element_id }} {
                top: {{ $item->y_position }};
                @if ($item->element_id == 'signature')
                    left: {{ $item->x_position }};
                @endif
            }
        @endforeach

        /* specifika (velikost písma, bílé mezery apod.) */
        #title { font-size: 22px; white-space: nowrap; }
        #subtitle { font-size: 14px; }
        #description { font-size: 14px; color: rgb(120,120,130); }
    </style>
</head>

<body>
    <div class="_certificate_boundary" style="background-image: url({{ public_path($certificate->background) }})">
        <div class="_text_box">
            <span id="title" class="_title _draggable_element">{{ @$certificate->title }}</span>
            <span id="subtitle" class="_subtitle _draggable_element">{{ @$certificate->subtitle }}</span>
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
