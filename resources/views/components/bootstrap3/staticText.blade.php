@if($isHorizontal)
    <div class="col-sm-{{ $fieldWidth }}">
@endif

{!! $controlHtml !!}

@if($isHorizontal)
    </div>
@endif
