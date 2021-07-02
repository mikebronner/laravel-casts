<x-form-group
    {{ $attributes->only(['x-show', 'x-if', 'x-model', 'x-ref']) }}
    :class="$groupClasses"
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    <div
        {{ $attributes->except(['x-show', 'x-if', 'x-model', 'x-ref'])->merge(["class" => ""]) }}
        x-data="ckeditor()"
        x-init="init($dispatch)"
        class="relative flex flex-col border border-gray-300 rounded-lg document-editor"
    >
        <div
            class="relative border-b border-gray-300 shadow-lg editor-toolbar"
        >
        </div>
        <div
            class="p-8 overflow-y-scroll bg-gray-200 shadow-inner"
        >
            <div
                class="bg-white rounded-sm shadow-md"
            >
                <div
                    class="editor"
                    id="{{ $name }}"
                >
                    {!! $value !!}
                </div>
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

@push ("css")
    <style>
        .editor-toolbar .ck.ck-toolbar {
            border-width: 0;
            border-radius: 0;
        }

        .editor .ck-editor__editable {
            /* Set the dimensions of the "page". */
            max-width: 21.8cm;

            /* Keep the "page" off the boundaries of the container. */
            padding: 1cm 2cm 2cm;
        }
    </style>
@endpush

@push ("js")
    <script src="{{ mix('js/ckeditor.js') }}"></script>

    <script>
        function ckeditor()
        {
            return {
                dispatch: null,
                editor: null,

                init: function (dispatch) {
                    let self = this;

                    this.dispatch = dispatch;

                    CKSource.Editor
                        .create(
                            document.querySelector('#{{ $name }}'),
                            {
                                toolbar: [
                                    'heading',
                                    '|',
                                    'bold',
                                    'italic',
                                    'underline',
                                    'strikethrough',
                                    'superscript',
                                    'subscript',
                                    'removeFormat',
                                    'pageBreak',
                                    '|',
                                    'alignment',
                                    '|',
                                    'numberedList',
                                    'bulletedList',
                                    'todoList',
                                    'outdent',
                                    'indent',
                                    '|',
                                    'specialCharacters',
                                    'pageBreak',
                                    'horizontalLine',
                                    'link',
                                    'blockQuote',
                                    'imageUpload',
                                    'imageInsert',
                                    'mediaEmbed',
                                    'insertTable',
                                    '|',
                                    'undo',
                                    'redo',
                                ],
                            }
                        )
                        .then(function (editor) {
                            const toolbarContainer = document.querySelector('.editor-toolbar');

                            editor.model.document.on("change:data", function (event, batch) {
                                self.changed(editor.getData());
                            });
                            this.editor = editor;

                            toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                        })
                        .catch(function (error) {
                            console.error(error);
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
