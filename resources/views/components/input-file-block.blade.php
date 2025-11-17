<div class="mb-3">
    <label class="form-label text-capitalize">{{ $label ? $label : $name }}</label>
    <input type="file" class="form-control" name="{{ $name }}">
    <x-input-error for="{{$name}}" class="mt-2" />
</div>
