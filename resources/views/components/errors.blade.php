@if ($errors)
    @if ($errors->count() > 1)
        <p class="mt-1 text-red-600 text-sm">
            {{ $error->first() }}
        </p>
    @else
        <ul class="ml-4 list-outside list-disc mt-1 text-red-600 text-sm">
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endif
