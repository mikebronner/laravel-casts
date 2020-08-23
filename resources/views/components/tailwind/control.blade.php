@if (((! $isInButtonGroup && $type !== 'endButtonGroup') || ($isInButtonGroup && $type === 'buttonGroup')) && $type !== 'subform' && $type !== 'button')
    @include ('genealabs-laravel-casts::components.tailwind.form-group-open')

    @if ($type !== 'checkbox' && $type !== 'button')
        @label ($name, $name, ['label' => $options['label'] ?? '', "class" => $options["labelClass"] ?? ""], $options['escapeLabel'] ?? false)
    @endif
@endif

@include ("genealabs-laravel-casts::components.tailwind.{$type}")

@if (! $isInButtonGroup && $type !== 'subform' && $type !== "button")
    @include('genealabs-laravel-casts::components.tailwind.form-group-close')
@endif
