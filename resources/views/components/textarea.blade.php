<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <textarea
        :name="$name"
        {!! $fieldAttributes !!}
    >
        {{ $value }}
    </textarea>
</x-form-group>
