@props(['for'])

@error($for)
    <ul {{ $attributes->merge(['class' => 'list-unstyled-nowrap text-danger']) }}>
        @foreach ((array) $message as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@enderror
