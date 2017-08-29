@if($isHorizontal)
<div class="col-sm-{{ $fieldWidth }}">
@endif

    <div class="custom-file" style="display: block;">
        {!! $controlHtml !!}
        <span class="custom-file-control{{ $errors->isEmpty() ? '' : $errors->has($name) ? ' form-control-danger' : ' form-control-success' }}"></span>
    </div>

    @if(! $errors->isEmpty() && $errors->has($name))
        <div class="invalid-feedback">{{ implode(' ', $errors->get($name)) }}</div>
    @endif

@if($isHorizontal)
</div>
@endif
