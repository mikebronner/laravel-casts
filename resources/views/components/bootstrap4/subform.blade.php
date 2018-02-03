<div class="col-sm-12 {{ str_replace('.', '', ($options['subFormClass'] ?? '')) . ' d-none' }}">
    <div class="popover popover-static bs-popover-bottom">
        <div class="arrow" style="left: 50%;"></div>

        @if (array_key_exists('subFormTitle', $options))
            <h3 class="popover-header">{{ $options['subFormTitle'] }}</h3>
        @endif

        <div class="popover-body">
            {!! csrf_field() !!}

            @include ($options['subFormBlade'])
            @endsubform

        </div>
    </div>
</div>
