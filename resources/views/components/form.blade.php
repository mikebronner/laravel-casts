@push ("js")
    <script>
        if (typeof window.resetForm === "undefined") {
            window.resetForm = function (form) {
                if ((form || false) === false) {
                    return;
                }

                _.each((form.elements || []), function (element) {
                    if (element.type === "submit") {
                        element.disabled = false;
                    }
                });
            };
        }

        if (typeof window.submitForm === "undefined") {
            window.submitForm = function (form) {
                if ((form || false) === false) {
                    return;
                }

                _.each((form.elements || []), function (element) {
                    if (element.type === "submit") {
                        element.disabled = true;
                    }
                });
            };
        }

        document.addEventListener("DOMContentLoaded", function () {
            Livewire.hook("message.processed", (livewireComponent) => {
                if (Object.keys(((((livewireComponent || {}).component || {}).serverMemo || {}).errors || {})).length > 0) {
                    _.each((document.querySelectorAll("form [type=submit]") || []), function (element) {
                        element.disabled = false;
                    });
                }
            });
        });
    </script>
@endpush

<form
    {{ $attributes }}
    autocomplete="{{ $autocomplete }}"
    class="{{ $class }}"
    enctype="{{ $enctype }}"
    id="form-{{ $key }}"
    method="{{ in_array(strtolower($method), ['post', 'get']) ? strtoupper($method) : 'POST' }}"
    target="{{ $target }}"

    @if ($action)
        action="{{ $action }}"
        onsubmit="window.submitForm(this);"
        onreset="window.resetForm(this);"
    @else
        onsubmit="window.submitForm(this); return false;"
        onreset="window.resetForm(this);"
    @endif
>
    @csrf()
    @method($method)

    {!! $slot !!}

</form>
