<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <select
        name="{{ $name }}"
        {{ $attributes }}

        @if ($isMultiSelect)
            multiple
        @endif
    >
        @if ($placeholder)
            <option selected disabled>{{ $placeholder }}</option>
        @endif

        @foreach ($options as $option)
            @if ($option->value === $selectedValue)
                <option value="{{ $option->value }}" selected>{{ $option->label }}</option>
            @else
                <option value="{{ $option->value }}">{{ $option->label }}</option>
            @endif
        @endforeach
    </select>
</x-form-group>
