<x-form-group
    {{ $attributes->whereStartsWith(['x-', 'wire:']) }}
    :class="$groupClasses"
    wire:ignore
>

    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    <div
        {{ $attributes->merge(["class" => ""])->whereDoesntStartWith(['x-', 'wire:']) }}
        x-data="tinymceAlpine()"
        x-init="init($dispatch)"
        class="relative flex flex-col border border-gray-300 rounded-lg document-editor"
    >
        <div
            class="overflow-hidden border rounded-lg"
        >
            <div
                id="{{ $name }}"
            >
                {!! $value !!}
            </div>
        </div>
    </div>

    @error($nameInDotNotation)
        <p class="mt-1 text-sm text-red-600">
            {{ str_replace($nameInDotNotation, "'{$label}'", $message) }}
        </p>
    @enderror

    <span
        class="text-sm italic text-gray-400"
    >
        {{ $helpText }}
    </span>
</x-form-group>

@push ("js")
    {{-- Todo: add npm package instead --}}
    <script
        src="https://cdn.tiny.cloud/1/{{ config("services.tinymce.api-key", "please-add-your-api-key") }}/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"
    ></script>
    <script>
        function tinymceAlpine()
        {
            return {
                dispatch: null,
                editor: null,

                init: function (dispatch) {
                    let self = this;

                    this.dispatch = dispatch;

                    tinymce.init({
                        selector: '#{{ $name }}',
                        {{-- menubar: 'edit view insert format tools table', --}}
                        menubar: '',
                        plugins: 'advcode casechange export fullscreen hr linkchecker autolink lists image advlist pagebreak powerpaste searchreplace table advtable tinymcespellchecker wordcount',
                        toolbar: 'undo redo | fontselect fontsizeselect | bold italic underline strikethrough superscript subscript removeformat pagebreak hr wordcount | align | outdent indent | bullist numlist table | casechange searchreplace | spellchecker spellcheckdialog | code export fullscreen',
                        toolbar_mode: 'sliding',
                        init_instance_callback: function (editor) {
                            editor.on('Change Undo Redo Paste', function (e) {
                                self.changed(tinymce.activeEditor.getContent());
                            });
                        },
                        max_height: 600,
                        branding: false,
                        paste_data_images: true,
                        pagebreak_separator: '<div style="page-break-before: always;"></div>'
                    });

                    this.dispatch("editor", this.editor);
                },

                changed: function (data) {
                    this.dispatch("input", data);
                },
            };
        }
    </script>
@endpush
