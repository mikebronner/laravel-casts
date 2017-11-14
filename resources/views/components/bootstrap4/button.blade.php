@if(! $isInButtonGroup)
    @if($isHorizontal)
        <div class="col-sm-{{ $fieldWidth }}{{ (trim($options['label'] ?? '') === '' ? ' offset-sm-' . $labelWidth : '') }}">
    @endif
@endif

{!! $controlHtml !!}

@if(! $isInButtonGroup)
    @if($isHorizontal)
        </div>
    @endif
@endif
