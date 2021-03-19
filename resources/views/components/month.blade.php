<x-form-group
    :class="$groupClasses"
    :errors="$errors"
    :helpText="$helpText"
>
    <input
        type="month"
        :name="$name"
        :value="$value"
        {!! $fieldAttributes !!}
    >
</x-form-group>
