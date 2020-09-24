@if ($errors)
    @if (count($errors) === 1)
        <p class="mt-1 text-red-600 text-sm">
            {{ collect($errors)->first() }}
        </p>
    @else
        <ul class="ml-4 list-outside list-disc mt-1 text-red-600 text-sm">
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endif
