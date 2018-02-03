{{-- @if(! $isInButtonGroup)
    @if($isHorizontal)
        <div class="col-sm-{{ $fieldWidth }}">
    @endif

    <div>
@endif --}}

{!! $controlHtml !!}

{{-- @if(! $isInButtonGroup)
    </div>

    @if($isHorizontal)
        </div>
    @endif
@endif --}}
