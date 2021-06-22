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
        class="document-editor relative border border-gray-300 rounded-lg flex flex-col"
    >
        <div
            class="editor-toolbar relative shadow-lg border-b border-gray-300"
        >
        </div>
        <div
            class="shadow-inner p-8 bg-gray-200 overflow-y-scroll"
        >
            <div
                class="bg-white shadow-md rounded-sm"
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
        <p class="mt-1 text-red-600 text-sm">
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
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/decoupled-document/ckeditor.js"></script>
    <script>
        function ckeditor()
        {
            return {
                dispatch: null,
                editor: null,

                init: function (dispatch) {
                    let self = this;

                    this.dispatch = dispatch;
                    DecoupledEditor
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
