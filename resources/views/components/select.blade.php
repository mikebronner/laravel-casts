<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <select
        id="{{ $id  }}"
        name="{{ $name }}"
        {{ $attributes }}

        @if ($isMultiSelect)
            multiple
        @endif
    >
        @if ($placeholder)
            <option selected disabled>{{ $placeholder }}</option>
        @endif


        @foreach ($options as $label => $value)
            {{-- @if ($value === $selectedValues)
                <option value="{{ $value }}" selected>{{ $label }}</option>
            @else --}}
                <option value="{{ $value }}">{{ $label }}</option>
            {{-- @endif --}}
        @endforeach
    </select>
</x-form-group>

@push ("css")
    @if ($isMultiSelect)
        <link
            href="{{ asset("vendor/laravel-casts/choices.min.css") }}"
            rel="stylesheet preload prefetch"
            as="style"
        >
        <link
            href="{{ asset("vendor/laravel-casts/choices.min.js") }}"
            rel="preload"
            as="script"
        >
    @endif
@endpush

@push ("js")
    <script
        src="{{ asset("vendor/laravel-casts/choices.min.js") }}"
    ></script>
    <script>
            let input = document.querySelector("#{{ $id }}");
            let choices = new window.Choices(input, {
                classNames: {
                    containerOuter: 'relative focus:outline-none',
                    containerInner: 'form-input pb-1',
                    input: 'outline-none',
                    inputCloned: 'inline-block',
                    list: 'choices__list',
                    listItems: 'choices__list--multiple',
                    listSingle: 'choices__list--single',
                    listDropdown: 'choices__list--dropdown',
                    item: 'choices__item px-2.5 py-0.5 rounded-md text-sm font-medium leading-5 bg-blue-100 text-blue-800 mb-1',
                    itemSelectable: 'choices__item--selectable block',
                    itemDisabled: 'choices__item--disabled',
                    itemChoice: 'none3',
                    placeholder: 'choices__placeholder',
                    group: 'choices__group',
                    groupHeading: 'choices__heading',
                    button: 'choices__button',
                    activeState: 'is-active',
                    focusState: 'is-focused',
                    openState: 'is-open',
                    disabledState: 'is-disabled',
                    highlightedState: 'bg-blue-100',
                    selectedState: 'bg-blue-100',
                    flippedState: 'is-flipped',
                    loadingState: 'is-loading',
                    noResults: 'has-no-results',
                    noChoices: 'has-no-choices',
                },
            });
    </script>
@endpush
