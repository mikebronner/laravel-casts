<div class="col-sm-{{ $fieldWidth }}">
    {!! $controlHtml !!}

    @if(! $errors->isEmpty() && $errors->has($name))
        <span class="help-block">{{ implode(' ', $errors->get($name)) }}</span>
    @endif
</div>
