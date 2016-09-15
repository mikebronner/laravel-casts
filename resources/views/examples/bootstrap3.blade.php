<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.datetimepicker/4.17.42/css/bootstrap-datetimepicker.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="page-header">Horizontal Form</h1>
                    @form(['url' => '', 'class' => 'form-horizontal', 'framework' => 'bootstrap3'])
                        @text('text', '', ['placeholder' => 'Placeholder Text', 'label' => 'Text Input'])
                        @password('password', ['placeholder' => 'Placeholder Text', 'label' => 'Password Input'])
                        @date('date', '', ['placeholder' => 'Placeholder Text', 'label' => 'Date'])
                        @datetime('datetime', '', ['placeholder' => 'Placeholder Text', 'label' => 'DateTime'])
                        @email('email', '', ['placeholder' => 'Placeholder Text', 'label' => 'Email Input'])
                        @url('url', '', ['placeholder' => 'Placeholder Text', 'label' => 'Url Input'])
                        @file('file', ['placeholder' => 'Placeholder Text', 'label' => 'File Input'])
                        @textarea('textarea', '', ['placeholder' => 'Placeholder Text', 'label' => 'Textarea', 'rows' => 7])
                        @checkbox('checkbox', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Checkbox'])
                        @select('select', [1, 2, 3, 4], null, ['placeholder' => 'Placeholder Text', 'label' => 'Select'])
                        @selectRange('selectRange', 1, 21, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range'])
                        @selectRangeWithInterval('selectRangeWithInterval', 1, 21, 3, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range With Interval'])
                        @combobox('combobox', [1, 2, 3, 4], null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Combobox'])
                        @submit('submit', ['class' => 'btn btn-success', 'label' => 'Submit Button'], '/bs3')
                    @endform
                </div>
                <div class="col-sm-6">
                    <h1 class="page-header">Normal Form</h1>
                    @form(['url' => '', 'framework' => 'bootstrap3'])
                        @text('text', '', ['placeholder' => 'Placeholder Text', 'label' => 'Text Input'])
                        @password('password', ['placeholder' => 'Placeholder Text', 'label' => 'Password Input'])
                        @date('date', '', ['placeholder' => 'Placeholder Text', 'label' => 'Date'])
                        @datetime('datetime', '', ['placeholder' => 'Placeholder Text', 'label' => 'DateTime'])
                        @email('email', '', ['placeholder' => 'Placeholder Text', 'label' => 'Email Input'])
                        @url('url', '', ['placeholder' => 'Placeholder Text', 'label' => 'Url Input'])
                        @file('file', ['placeholder' => 'Placeholder Text', 'label' => 'File Input'])
                        @textarea('textarea', '', ['placeholder' => 'Placeholder Text', 'label' => 'Textarea', 'rows' => 7])
                        @checkbox('checkbox', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Checkbox'])
                        @select('select', [1, 2, 3, 4], null, ['placeholder' => 'Placeholder Text', 'label' => 'Select'])
                        @selectRange('selectRange', 1, 21, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range'])
                        @selectRangeWithInterval('selectRangeWithInterval', 1, 21, 3, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range With Interval'])
                        @combobox('combobox', [1, 2, 3, 4], null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Combobox'])
                        @submit('submit', ['class' => 'btn btn-success', 'label' => 'Submit Button'], '/bs3')
                    @endform
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/bootstrap.datetimepicker/4.17.42/js/bootstrap-datetimepicker.min.js"></script>
        <script>
            if (window.$) {
                $(function () {
                    if ( $.isFunction($.fn.datetimepicker) ) {
                        $('input[type=date]').datetimepicker({
                            format: 'LL'
                        });

                        $('input[type=datetime]').datetimepicker({
                            format: 'LLL',
                            sideBySide: true
                        });
                    }
                });
            }
        </script>
    </body>
</html>
