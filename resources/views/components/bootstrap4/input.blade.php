<div class="col-sm-{{ $fieldWidth }}">
    {!! $controlHtml !!}

    @if(! $errors->isEmpty() && $errors->has($name))
        {{-- <small class="form-text text-muted">{{ implode(' ', $errors->get($name)) }}</small> --}}
    @endif
</div>
