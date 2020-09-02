<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <input
        type="range"
        :name="$name"
        :value="$value"
        {!! $fieldAttributes !!}
    >
</x-form-group>
