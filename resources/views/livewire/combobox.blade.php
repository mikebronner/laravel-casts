<div
    class="w-full"
>
    <input
        type="hidden"
        name="{{ $fieldName }}"
        value="{{ $selectedValue }}"
    >
    <input
        id="{{ $fieldName }}"
        class="form-input w-full font-normal"
        wire:keydown.backspace="resetSearch('{{ $key }}')"
        wire:model.debounce.200ms="search"
        type="text"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
        name="search"
    >

    <div>
    @if (! $createFormIsVisible && ! $selectedValue && $search)
        <div
            class="absolute z-50 bg-white border border-gray-300 rounded shadow-md"
        >

            @if ($search && $results->isEmpty())
                @if ($createFormView)
                    <div
                        wire:click="showCreateForm('{{ $key }}')"
                        class="px-3 py-1 block cursor-pointer bg-transparent hover:bg-gray-300"
                    >
                        Add {{ $search }} ...
                    </div>
                @else
                    <div
                        class="px-3 py-1 block bg-transparent"
                    >
                        No results found.
                    </div>
                @endif
            @endif

            @foreach ($results as $result)
                <div
                    class="px-3 py-1 block cursor-pointer bg-transparent hover:bg-gray-300"
                    wire:click="select('{{ $result->$valueField }}', '{{ $result->$labelField }}', '{{ $key }}')"
                    wire:key="search-option-{{ $result->getKey() }}-{{ $key }}"
                >
                    {{ $result->$labelField }}
                </div>
            @endforeach

        </div>
    @endif
    </div>
    <div>
    @if ($createFormIsVisible)
        <fieldset
            class="mt-4 mb-8 border-4 border-blue-400 rounded-lg"
            id="{{ \Illuminate\Support\Str::slug($label) . "-" . $key }}"
            x-data="subFormController('{{ $createFormUrl }}')"
            x-init="() => {loadForm('{{ \Illuminate\Support\Str::slug($label) . "-" . $key }}', '{{ $search }}', '{{ $searchField }}');}"
        >
            <legend>Add New {{ $label }}</legend>
            @form
            @include ($createFormView)
            <div class="flex">
                @button ("Add New Repository", ["x-on:click" => "submitForm('" . \Illuminate\Support\Str::slug($label) . "-" . $key . "', '" . $key . "', '" . \Illuminate\Support\Str::slug($label) . "');", "class" => "button button-primary button-outlined"])
                @button ("Cancel", ["wire:click" => "cancelForm('{$key}')", "class" => "button button-secondary button-link"])
            </div>
            @endform
        </fieldset>
    @endif
    </div>
</div>

@push ("scripts")
<script>
    function subFormController(postUrl) {
        return {
            action : postUrl,

            formData: {
                _token: document.querySelector("meta[name=csrf_token]").getAttribute('content'),
            },

            loadForm: function (formId, value, fieldName) {
                var hasFocused = false;
                var formElements = document.getElementById(formId).elements;

                for (var i = 0, formElement; formElement = formElements[i++];) {
                    if (hasFocused == false && formElement.type !== "hidden") {
                        formElement.focus();
                        hasFocused = true;
                    }

                    if (formElement.name == fieldName) {
                        formElement.value = value;
                    }
                }
            },

            submitForm: function (formId, id, targetId) {
                var formData = new FormData();
                var formElements = document.getElementById(formId).elements;

                for (var i = 0, formElement; formElement = formElements[i++];) {
                    if (formElement.name.length > 0
                        && formElement.value.length > 0
                    ) {
                        this.formData[formElement.name] = formElement.value;
                    }
                }

                for (let [key, value] of Object.entries(this.formData)) {
                    formData.append(key, value);
                }

                axios
                    .post(this.action, formData)
                    .then(function (response) {
                        console.log("test1");
                        window.livewire.emit('updateSelectedItem' + id, response.data, id);
                        console.log("test2");
                    })
                    .catch(function (error) {
                        if ((((error || {}).response || {}).status || 200) === 422) {
                            window.livewire.emit('setErrors' + id, error.response.data, id);
                        } else {
                            console.error(error);
                        }
                    });
            },
        };
    }
</script>
@endpush
