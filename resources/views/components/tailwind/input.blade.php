@if($isHorizontal)
    <div class="my-4">
@endif

    {!! $controlHtml !!}

    @if(! $errors->isEmpty() && $errors->has($name))
        <div class="text-sm text-red-600 italic">{{ implode(' ', $errors->get($name)) }}</div>
    @endif

@if($isHorizontal)
    </div>
@endif
