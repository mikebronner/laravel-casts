@if($isHorizontal)
{{-- <div class="ml-auto col-sm-{{ $fieldWidth }}"> --}}
<div class="my-4">
@endif

    <label class="{{ $options["labelClass"] ?? "" }}">
        {!! $controlHtml !!}
    </label>

    @if(! $errors->isEmpty() && $errors->has($name))
        <div class="text-sm text-red-600 italic">{{ implode(' ', $errors->get($name)) }}</div>
    @endif

@if($isHorizontal)
</div>
@endif
