@if($isHorizontal)
<div class="col-sm-{{ $fieldWidth }} col-sm-offset-{{ $labelWidth }}">
@endif

    {!! $controlHtml !!}

@if($isHorizontal)
</div>
@endif
