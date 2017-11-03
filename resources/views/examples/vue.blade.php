@extends('genealabs-laravel-casts::examples.layout')

@section('head')
    <link href="/css/bootstrap3.css" rel="stylesheet" type="text/css" media="all">
@endsection

@section('content')
    <div class="container">
        <cast-form>
            <cast-checkbox name="checkbox"></cast-checkbox>
        </cast-form>
        {{-- @form(['url' => ''])
            @text('text', '', ['placeholder' => 'Placeholder Text', 'label' => 'Text Input'])
            @password('password', ['placeholder' => 'Placeholder Text', 'label' => 'Password Input'])
            @email('email', '', ['placeholder' => 'Placeholder Text', 'label' => 'Email Input'])
            @url('url', '', ['placeholder' => 'Placeholder Text', 'label' => 'Url Input'])
            @file('file', ['placeholder' => 'Placeholder Text', 'label' => 'File Input'])
            @search ('search', 'search term', ['placeholder' => 'Placeholder Text', 'label' => 'Search Input'])
            @number ('number', 5, ['placeholder' => 'Placeholder Text', 'label' => 'Number Input'])
            @color ('color', '#ff0000', ['placeholder' => 'Placeholder Text', 'label' => 'Color Input'])
            @range ('range', 5, ['placeholder' => 'Placeholder Text', 'label' => 'Range Input'])
            @tel ('tel', '1234567890', ['placeholder' => 'Placeholder Text', 'label' => 'Tel Input'])
            @week ('week', 3, ['placeholder' => 'Placeholder Text', 'label' => 'Week Input'])
            @month ('month', 'January', ['placeholder' => 'Placeholder Text', 'label' => 'Month Input'])
            @textarea('textarea', '', ['placeholder' => 'Placeholder Text', 'label' => 'Textarea', 'rows' => 7])
            @checkbox('checkbox', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Checkbox'])
            @radio('radio', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Radio'])
            @select('select', [1, 2, 3, 4], null, ['placeholder' => 'Placeholder Text', 'label' => 'Select'])
            @selectMonths('selectMonths', 3, ['placeholder' => 'Placeholder Text', 'label' => 'Select Months'])
            @selectWeekdays('selectWeekdays', 3, ['placeholder' => 'Placeholder Text', 'label' => 'Select Weekdays'])
            @selectRange('selectRange', 1, 21, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range'])
            @selectRangeWithInterval('selectRangeWithInterval', 1, 21, 3, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range With Interval'])
            @combobox('combobox', [1, 2, 3, 4], null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Combobox'])
            @submit('submit', ['class' => 'btn btn-success', 'label' => 'Submit Button'], '/bs3')
        @endform --}}
    </div>
@endsection

@section('footer')
    <script src="{!! asset('genealabs-laravel-casts/tether.js') !!}"></script>
    <script src="{!! asset('genealabs-laravel-casts/bootstrap4.js') !!}"></script>

    @yield ('js')
@endsection
