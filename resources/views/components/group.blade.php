<div
    {{ $attributes }}
>
    {{ $slot }}
    <x-form-errors
        :errors="$errorData"
    />
    <span
        class="text-sm italic text-gray-400"
    >
        {{ $helpText }}
    </span>
</div>
