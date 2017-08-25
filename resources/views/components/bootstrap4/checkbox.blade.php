@if($isHorizontal)
<div class="ml-auto col-sm-{{ $fieldWidth }}">
@endif

    <div class="form-check">
        <label class="form-check-label">
            {!! $controlHtml !!}
        </label>
    </div>

    @if(! $errors->isEmpty() && $errors->has($name))
        <small class="form-control-feedback">{{ implode(' ', $errors->get($name)) }}</small>
    @endif

@if($isHorizontal)
</div>
@endif
