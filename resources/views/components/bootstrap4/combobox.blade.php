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
                    @if(array_key_exists('createCallback', $options))
                        {{ $options['createCallback'] }}(name);
                    @endif

                    return {'text': name, 'value': -1};
                },
                onChange: function (value) {
                    @if(array_key_exists('changeCallback', $options))
                        {{ $options['changeCallback'] }}(value);
                    @endif

                    if (value == -1) {
                        $('.{{ $options['subFormClass'] }}').removeClass('hidden-xs-up');
                        $('.{{ $options['subFormClass'] }} [name="{{ $options['subFormFieldName'] }}"]').val(selectedContactName);
                    } else {
                        $('[name={{ $name }}]').selectize()[0].selectize.removeOption(-1);
                        $('.{{ $options['subFormClass'] }}').addClass('hidden-xs-up');
                        $('.{{ $options['subFormClass'] }} [name="{{ $options['subFormFieldName'] }}"]').val('');
                    }
                }
            });

            document.querySelector('.{!! $options['subFormClass'] !!} input[type="submit"]').addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();

                $('.new-contact-form').find('input,textarea,select').each(function (index, control) {
                    $(control).removeClass('form-control-danger').removeClass('form-control-success');
                    $(control).closest('.form-group').removeClass('has-danger').removeClass('has-success');
                    $(control).closest('.form-group').find('.form-control-feedback').remove();
                });

                window.axios.post('{!! route('api.contacts.store') !!}',
                    $('.{{ $options['subFormClass'] }}').find('input,textarea,select').serialize()
                ).then(function (response) {
                    var combobox = $('[name={{ $name }}]').selectize()[0].selectize;
                    combobox.removeOption(-1);
                    combobox.addOption({'value': response.data.id, 'text': response.data.name});
                    combobox.refreshOptions();
                    combobox.setValue(response.data.id);
                }).catch(function (error) {
                    $('.{{ $options['subFormClass'] }}').find('input,textarea,select').each(function (index, control) {
                        if ($(control).attr('type') != 'submit') {
                            $(control).addClass('form-control-success');
                            $(control).closest('.form-group').addClass('has-success');
                        }
                    });

                    _.forOwn(error.response.data, function (message, field) {
                        $('[name=' + field + ']').addClass('form-control-danger');
                        $('[name=' + field + ']').closest('.form-group').addClass('has-danger');
                        $('[name=' + field + ']').after('<small class="form-control-feedback">' + _.join(message, '<br>') + '</small>');
                    });
                });

                return false;
            });
        });
    </script>

@if($isHorizontal)
    </div>
@endif

@if(array_key_exists('subFormClass', $options))
    @include('genealabs-laravel-casts::components.bootstrap4.form-group-close')

    @include('genealabs-laravel-casts::components.bootstrap4.form-group-open', ['additionalClasses' => "{$options['subFormClass']} hidden-xs-up"])
        <div class="col-sm-12">
            <div class="popover popover-static popover-bottom">

                @if(array_key_exists('subFormTitle', $options))
                    <h3 class="popover-title">{{ $options['subFormTitle'] }}</h3>
                @endif

                <div class="popover-content">
                    <?= csrf_field() ?>
                    @include($options['subFormBlade'])
                </div>
            </div>
        </div>
@endif
