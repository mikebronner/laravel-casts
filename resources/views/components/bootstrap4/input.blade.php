<div class="col-sm-{{ $fieldWidth }}">
    {!! $controlHtml !!}

    @if(! $errors->isEmpty() && $errors->has($name))
        <small class="form-text text-danger">{{ implode(' ', $errors->get($name)) }}</small>
    @endif
</div>
