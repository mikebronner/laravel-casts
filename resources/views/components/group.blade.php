<div
    {{ $attributes }}
>
    {{ $slot }}

    @error($name)
        <p class="mt-1 text-red-600 text-sm">
            {{ $message }}
        </p>
    @enderror

    <span
        class="text-sm italic text-gray-400"
    >
        {{ $helpText }}
    </span>
</div>
