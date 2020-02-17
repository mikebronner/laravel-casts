@if ($isHorizontal)
    <div class="col-sm-{{ $fieldWidth }}">
@endif

<div class="input-group date" id="{{ $options['data-target'] }}" data-target-input="nearest">
    {!! $controlHtml !!}
    <div class="input-group-append" data-target="#{{ $options['data-target'] }}" data-toggle="datetimepicker">
        <div class="input-group-text">
            <i class="fa fa-btn fa-calendar"></i>
        </div>
    </div>
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
        window.genealabsLaravelCasts['framework'] = 'bootstrap4';
        window.genealabsLaravelCasts['dateTimeLoaders'] = window.genealabsLaravelCasts.dateTimeLoaders || [];
        window.genealabsLaravelCasts.dateTimeLoaders.push(function () {
            $("#{{ $options['data-target'] }}").datetimepicker({
                allowInputToggle: true,
                format: 'lll',
                date: '{{ $options['value'] }}',
                sideBySide: true,
                icons: {
                    time: "fa fa-btn fa-clock-o",
                    date: "fa fa-btn fa-calendar",
                    up: "fa fa-btn fa-arrow-up",
                    down: "fa fa-btn fa-arrow-down"
                },
                locale: "{{ config('app.locale') }}",
                useCurrent: false,
                widgetPositioning: {horizontal: 'left'}
            });
        });
    </script>
@endsection
