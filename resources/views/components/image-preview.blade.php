{{-- resources\views\components\image.preview.blade.php --}}
<div>
    <img {{ $attributes->merge(['class' => 'img-fluid mb-3', 'style' => 'width:150px !important; object-fit:cover !important;']) }}>
</div>
