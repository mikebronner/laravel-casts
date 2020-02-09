@if($isHorizontal)
    <div class="col-sm-{{ $fieldWidth }}">
@endif

<div>
    {!! $controlHtml !!}
</div>

@if(! $errors->isEmpty() && $errors->has($name))
    <div class="invalid-feedback">{{ implode(' ', $errors->get($name)) }}</div>
@endif

@if($isHorizontal)
    </div>
@endif
