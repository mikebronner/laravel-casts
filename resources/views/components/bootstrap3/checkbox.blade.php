<div class="col-sm-offset-{{ $labelWidth }} col-sm-{{ $fieldWidth }}">
    <div class="checkbox">
        <label>
            {!! $controlHtml !!}
        </label>
    </div>

    @if(! $errors->isEmpty() && $errors->has($name))
        <span class="help-block">{{ implode(' ', $errors->get($name)) }}</span>
    @endif
</div>
