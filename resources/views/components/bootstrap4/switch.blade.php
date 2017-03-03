@if($isHorizontal)
<div class="col-sm-{{ $fieldWidth }}">
@endif

    <div>
        {!! $controlHtml !!}
    </div>

    @if($name)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $("[name='{{ $name }}']").bootstrapSwitch({
                    onText: "{{ $options['onText'] ?? 'On' }}",
                    offText: "{{ $options['offText'] ?? 'Off' }}",
                    onColor: "{{ $options['onColor'] ?? 'info' }}",
                    offColor: "{{ $options['offColor'] ?? 'default' }}"
                });
            });
        </script>
    @endif

    @if(! $errors->isEmpty() && $errors->has($name))
        <small class="form-text text-danger">{{ implode(' ', $errors->get($name)) }}</small>
    @endif

@if($isHorizontal)
</div>
@endif
