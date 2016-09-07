@if($isHorizontal)
<div class="offset-sm-{{ $labelWidth }} col-sm-{{ $fieldWidth }}">
@endif

    <div class="form-check">
        <label class="form-check-label">
            {!! $controlHtml !!}
        </label>
    </div>

    @if(! $errors->isEmpty() && $errors->has($name))
        <span class="help-block">{{ implode(' ', $errors->get($name)) }}</span>
    @endif

@if($isHorizontal)
</div>
@endif
