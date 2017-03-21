@if($isHorizontal)
    <div class="col-sm-{{ $fieldWidth }}">
@endif

    {{-- <div> --}}
        {!! $controlHtml !!}
    {{-- </div> --}}

@if($isHorizontal)
    </div>
@endif
