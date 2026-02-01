{{-- resources/views/components/tabler-icon.blade.php --}}
<svg {{ $attributes->merge(['class' => $class]) }}>
    <use href="{{ $spriteUrl }}#{{ $iconId }}"></use>
</svg>
