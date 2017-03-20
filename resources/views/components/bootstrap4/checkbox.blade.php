@if($isHorizontal)
<div class="offset-sm-{{ $labelWidth }} col-sm-{{ $fieldWidth }}">
@endif

    <div class="form-check">
        <label class="form-check-label">
            {!! $controlHtml !!}
        </label>
    </div>

    @if(! $errors->isEmpty() && $errors->has($name))
        <small class="form-text text-danger">{{ implode(' ', $errors->get($name)) }}</small>
    @endif

@if($isHorizontal)
</div>
@endif
