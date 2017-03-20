@if($isHorizontal)
<div class="col-sm-{{ $fieldWidth }}">
@endif

    <div class="custom-file" style="display: block;">
        {!! $controlHtml !!}
        <span class="custom-file-control{{ $errors->isEmpty() ? '' : $errors->has($name) ? ' form-control-danger' : ' form-control-success' }}"></span>
    </div>

    @if(! $errors->isEmpty() && $errors->has($name))
        <small class="form-control-feedback">{{ implode(' ', $errors->get($name)) }}</small>
    @endif

@if($isHorizontal)
</div>
@endif
