@if($isHorizontal)
<div class="col-sm-{{ $fieldWidth }}">
@endif

    {!! $controlHtml !!}

    @if(! $errors->isEmpty() && $errors->has($name))
        <span class="help-block">{{ implode(' ', $errors->get($name)) }}</span>
    @endif

@if($isHorizontal)
</div>
@endif
