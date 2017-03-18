@if($isHorizontal)
    <div class="col-sm-{{ $fieldWidth }}">
@endif

    <div class="input-group date" id="datetimepicker-{{ $name }}" data-target-input="nearest">
        {!! $controlHtml !!}
        <span class="input-group-addon" data-target="#datetimepicker-{{ $name }}" data-toggle="datetimepicker">
            <i class="fa fa-btn fa-calendar"></i>
        </span>
    </div>

    <script>
        window['genealabsLaravelCasts'] = window.genealabsLaravelCasts || {};
        window.genealabsLaravelCasts['dateTimeLoaders'] = window.genealabsLaravelCasts.dateTimeLoaders || [];
        window.genealabsLaravelCasts.dateTimeLoaders.push(function () {
            $("#datetimepicker-{{ $name }}").datetimepicker({
                format: 'll',
                icons: {
                    time: "fa fa-btn fa-clock-o",
                    date: "fa fa-btn fa-calendar",
                    up: "fa fa-btn fa-arrow-up",
                    down: "fa fa-btn fa-arrow-down"
                },
                locale: "{{ config('app.locale') }}"
            });
        });
    </script>

    @if(! $errors->isEmpty() && $errors->has($name))
        <span class="help-block">{{ implode(' ', $errors->get($name)) }}</span>
    @endif

@if($isHorizontal)
    </div>
@endif
