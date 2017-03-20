@if($isHorizontal)
<div class="col-sm-{{ $fieldWidth }} custom-file">
@endif

    {!! $controlHtml !!}
    <span class="custom-file-control" style="right: 15px; left: 15px;"></span>

    @if(! $errors->isEmpty() && $errors->has($name))
        <small class="form-text text-danger">{{ implode(' ', $errors->get($name)) }}</small>
    @endif

@if($isHorizontal)
</div>
@endif
