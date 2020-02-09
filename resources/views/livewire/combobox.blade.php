<div
    class="w-full"
>
    <input
        type="hidden"
        name="{{ $fieldName }}"
        value="{{ $selectedValue }}"
    >
    <input
        id="{{ $fieldName }}"
        class="form-input w-full font-normal"
        wire:keydown.backspace="resetSearch"
        wire:model="search"
        type="text"
        placeholder="{{ $placeholder }}"
    >

    @if (! $createFormIsVisible && ! $selectedValue && $search)
        <div
            class="absolute z-50 bg-white border border-gray-300 rounded shadow-md"
        >

            @if ($search && $results->isEmpty())
                <div
                    {{-- wire:click="showCreateForm" --}}
                    {{-- class="px-3 py-1 block cursor-pointer bg-transparent hover:bg-gray-300" --}}
                    class="px-3 py-1 block bg-transparent"
                >
                    No results found.
                    {{-- Add {{ $search }} ... --}}
                </div>
            @endif

            @foreach ($results as $result)
                <div
                    class="px-3 py-1 block cursor-pointer bg-transparent hover:bg-gray-300"
                    wire:click="select('{{ $result->$valueField }}', '{{ $result->$labelField }}')"
                >
                    {{ $result->$labelField }}
                </div>
            @endforeach

        </div>
    @endif

    @if ($createFormIsVisible)
        @include ($createFormView)
    @endif
</div>
