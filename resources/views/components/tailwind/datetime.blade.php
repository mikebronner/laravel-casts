@if ($isHorizontal)
    <div class="col-sm-{{ $fieldWidth }}">
@endif

<div class="relative">
    {!! $controlHtml !!}
    <i
        class="p-3 -ml-10 absolute block fa fa-calendar text-gray-400 pointer-events-none"
    ></i>
</div>

@if (! $errors->isEmpty() && $errors->has($name))
    <div class="text-sm text-red-600 italic">{{ implode(' ', $errors->get($name)) }}</div>
@endif

@if ($isHorizontal)
    </div>
@endif

@section ('genealabs-laravel-casts')
    @parent

    <script>
        window['genealabsLaravelCasts'] = window.genealabsLaravelCasts || {};
        window.genealabsLaravelCasts['framework'] = 'tailwind';
        window.genealabsLaravelCasts['dateTimeLoaders'] = window.genealabsLaravelCasts.dateTimeLoaders || [];
        window.genealabsLaravelCasts.dateTimeLoaders.push(function () {
            flatpickr("[data-target='{{ $options['data-target'] }}'", {
                altInput: true,
                altFormat: 'j F Y \\a\\t H:i',
                enableTime: true,
                dateFormat: "Y-m-d H:i"
            });
        });
    </script>
@endsection
