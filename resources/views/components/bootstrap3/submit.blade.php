@if ($isHorizontal)
    @if (array_key_exists('cancelUrl', $options))
        <div class="col-sm-{{ $labelWidth }}">
            {!! link_to(collect($options)->get('cancelUrl'), 'Cancel', ['class' => 'btn btn-default pull-right']) !!}
        </div>
        <div class="col-sm-{{ $fieldWidth }}">
    @else
        <div class="col-sm-{{ $fieldWidth }} col-sm-offset-{{ $labelWidth }}">
    @endif
@elseif (array_key_exists('cancelUrl', $options))
    {!! link_to(collect($options)->get('cancelUrl'), 'Cancel', ['class' => 'btn btn-default']) !!}
@endif

{!! $controlHtml !!}

@if ($isHorizontal)
    </div>
@endif
