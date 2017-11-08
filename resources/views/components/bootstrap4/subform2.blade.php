@include ('genealabs-laravel-casts::components.bootstrap4.form-group-close')
@include ('genealabs-laravel-casts::components.bootstrap4.form-group-open', ['classes' => str_replace('.', '', ($options['subFormClass'] ?? '')) . ' d-none'])

<div class="col-sm-12">
    <div class="popover popover-static popover-bottom">

        @if (array_key_exists('subFormTitle', $options))
            <h3 class="popover-header">{{ $options['subFormTitle'] }}</h3>
        @endif

        <div class="popover-body">
            {!! csrf_field() !!}

            @include ($options['subFormBlade'])
            @endSubForm

        </div>
    </div>
</div>
