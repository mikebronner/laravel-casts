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
                sortField: [
                    {
                        field: 'text',
                        direction: 'asc'
                    },
                    {
                        field: '$score'
                    }
                ],
                create: function (name) {
                    @if(array_key_exists('createCallback')
                        {{ $options['createFunction'] }}(name);
                    @endif
                    
                    return {'text': name, 'value': -1};
                },
                onChange: function (value) {
                    @if(array_key_exists('changeCallback')
                        {{ $options['changeFunction'] }}(value);
                    @endif

                    if (value == -1) {
                        $('{{ $options['subFormSelector'] }}').removeClass('hidden-xs-up');
                        $('{{ $options['subFormSelector'] }} [name="{{ $options['subFormFieldName'] }}"]').val(selectedContactName);
                    } else {
                        $('[name={{ $name }}]').selectize()[0].selectize.removeOption(-1);
                        $('{{ $options['subFormSelector'] }}').addClass('hidden-xs-up');
                        $('{{ $options['subFormSelector'] }} [name="{{ $options['subFormFieldName'] }}"]').val('');
                    }
                }
            });
        });
    </script>

@if($isHorizontal)
    </div>
@endif
