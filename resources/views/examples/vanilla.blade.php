<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vanilla Form Components</title>
  </head>
    <body>
        <div class="container">
            @form(['url' => ''])
                @text('text', '', ['placeholder' => 'Placeholder Text', 'label' => 'Text Input'])
                @password('password', ['placeholder' => 'Placeholder Text', 'label' => 'Password Input'])
                @email('email', '', ['placeholder' => 'Placeholder Text', 'label' => 'Email Input'])
                @url('url', '', ['placeholder' => 'Placeholder Text', 'label' => 'Url Input'])
                @file('file', ['placeholder' => 'Placeholder Text', 'label' => 'File Input'])
                @search ('search', 'search term', ['placeholder' => 'Placeholder Text', 'label' => 'Search Input'])
                @number ('number1', 5, ['placeholder' => 'Placeholder Text', 'label' => 'Number Input'])
                @range ('range', 5, ['placeholder' => 'Placeholder Text', 'label' => 'Range Input'])
                @tel ('tel', '1234567890', ['placeholder' => 'Placeholder Text', 'label' => 'Tel Input'])
                @week ('week', 3, ['placeholder' => 'Placeholder Text', 'label' => 'Week Input'])
                @month ('month', 'January', ['placeholder' => 'Placeholder Text', 'label' => 'Month Input'])
                @textarea('textarea', '', ['placeholder' => 'Placeholder Text', 'label' => 'Textarea', 'rows' => 7])
                @checkbox('checkbox', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Checkbox'])
                @select('select', [1, 2, 3, 4], null, ['placeholder' => 'Placeholder Text', 'label' => 'Select'])
                @selectMonths('selectMonths', 3, ['placeholder' => 'Placeholder Text', 'label' => 'Select Months'])
                @selectWeekdays('selectWeekdays', 3, ['placeholder' => 'Placeholder Text', 'label' => 'Select Weekdays'])
                @selectRange('selectRange', 1, 21, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range'])
                @selectRangeWithInterval('selectRangeWithInterval', 1, 21, 3, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range With Interval'])
                @combobox('combobox', [1, 2, 3, 4], null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Combobox'])
                @submit('submit', ['class' => 'btn btn-success', 'label' => 'Submit Button'], '/bs3')
            @endform
        </div>
    </body>
</html>
