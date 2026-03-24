{{-- resources/views/components/image-preview.blade.php --}}
<div {{ $attributes->merge(['class' => 'overflow-x-auto overflow-y-hidden max-w-full mb-3']) }} style="height: 150px !important;">
    <img
        src="{{ $src ?? '#' }}"
        class="block object-contain"
        style="
            height: auto !important;
            max-height: 150px !important;
            width: auto !important;
            max-width: none !important;
        ">
</div>
