<div class="mb-3">
    <label class="form-label text-capitalize">{{ $label ? $label : $name }}</label>
    <input type="text" class="form-control" name="{{$name}}" value="{{$value}}" placeholder="{{$placeholder}}">
    <x-input-error for="{{$name}}" class="mt-2" />
    @isset($hint)
        {{$hint}}
    @endisset
</div>
