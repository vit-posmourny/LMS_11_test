<svg {{ $attributes->merge(['class' => $class]) }}>
    <use href="{{ $spriteUrl }}#{{ $iconId }}"></use>
</svg>
