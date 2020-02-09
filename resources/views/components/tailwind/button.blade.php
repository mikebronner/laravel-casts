@if(! $isInButtonGroup)
    @if($isHorizontal)
        <div class="col-sm-{{ $fieldWidth }}{{ $options['offsetClass'] ?? '' }}">
    @endif
@endif

{!! $controlHtml !!}

@if(! $isInButtonGroup)
    @if($isHorizontal)
        </div>
    @endif
@endif
