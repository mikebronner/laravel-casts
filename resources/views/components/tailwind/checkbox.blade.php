@if($isHorizontal)
{{-- <div class="ml-auto col-sm-{{ $fieldWidth }}"> --}}
<div class="my-4">
@endif

    <label class="m-0 leading-none">
        {!! $controlHtml !!}
    </label>

    @if(! $errors->isEmpty() && $errors->has($name))
        <div class="invalid-feedback">{{ implode(' ', $errors->get($name)) }}</div>
    @endif

@if($isHorizontal)
</div>
@endif
