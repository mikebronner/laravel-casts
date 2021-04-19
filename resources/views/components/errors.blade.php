@if ($errorData)
    @if (count($errorData) === 1)
        <p class="mt-1 text-red-600 text-sm">
            {{ collect($errorData)->first() }}
        </p>
    @else
        <ul class="ml-4 list-outside list-disc mt-1 text-red-600 text-sm">
            @foreach ($errorData as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endif
