@if($isHorizontal)
<div class="ml-auto col-sm-{{ $fieldWidth }}">
@endif

    <div class="form-check">
        <label class="form-check-label">
            {!! $controlHtml !!}
        </label>
    </div>

    @if(! $errors->isEmpty() && $errors->has($name))
        <div class="invalid-feedback">{{ implode(' ', $errors->get($name)) }}</div>
    @endif

@if($isHorizontal)
</div>
@endif
