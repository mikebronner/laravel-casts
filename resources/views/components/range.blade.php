<x-form-group
    :class="$groupClasses"
    :errors="$errors"
    :helpText="$helpText"
>
    <input
        type="range"
        :name="$name"
        :value="$value"
        {!! $fieldAttributes !!}
    >
</x-form-group>
