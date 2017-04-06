@if($isHorizontal)
    <div class="col-sm-{{ $fieldWidth }}">
@endif

    {!! $controlHtml !!}

    @if(! $errors->isEmpty() && ! $errors->has($name))
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true" style="margin-right: 35px;"></span>
        <span id="inputSuccess2Status" class="sr-only">(success)</span>
    @endif

    @if(! $errors->isEmpty() && $errors->has($name))
        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" style="margin-right: 35px;"></span>
        <span id="inputError2Status" class="sr-only">(error)</span>
        <span class="help-block">{{ implode(' ', $errors->get($name)) }}</span>
    @endif
    <script>
        window['genealabsLaravelCasts'] = window.genealabsLaravelCasts || {};
        window.genealabsLaravelCasts['comboboxLoaders'] = window.genealabsLaravelCasts.comboboxLoaders || [];
        window.genealabsLaravelCasts.comboboxLoaders.push(function () {
            $('[name="{{ $name }}"]').selectize({
                options: {!! $options['list'] !!},
                list: {!! $options['selected'] !!},
                labelField: 'text',
                valueField: 'value',
                create: {{ $options['createFunction'] }},
                onChange: {{ $options['changeFunction'] }}
            });
        });
    </script>

@if($isHorizontal)
    </div>
@endif
