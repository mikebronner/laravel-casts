<div
    {{ $attributes }}
>
    {{ $slot }}
    <x-form-errors
        :errorData="$errorData"
    />
    <span
        class="text-sm italic text-gray-400"
    >
        {{ $helpText }}
    </span>
</div>
