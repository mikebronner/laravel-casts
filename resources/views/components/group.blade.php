<div
    {{ $attributes }}
>
    {{ $slot }}

    @error($name)
        <p class="mt-1 text-red-600 text-sm">
            {{ $message }}
        </p>
    @enderror

    <x-form-errors
        :errorData="$errorData"
    />
    <span
        class="text-sm italic text-gray-400"
    >
        {{ $helpText }}
    </span>
</div>
