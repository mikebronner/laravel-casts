@if($isHorizontal)
    <div class="col-sm-offset-{{ $labelWidth }} col-sm-{{ $fieldWidth }}">
@endif

<div class="radio">
    <label>
        {!! $controlHtml !!}
    </label>
</div>

@if(! $errors->isEmpty() && $errors->has($name))
    <span class="help-block">{{ implode(' ', $errors->get($name)) }}</span>
@endif

@if($isHorizontal)
    </div>
@endif
