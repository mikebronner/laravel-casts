![laravel-casts](https://cloud.githubusercontent.com/assets/1791050/18258832/b7c177d6-7391-11e6-99ba-ea7e63735cd8.jpg)

# Laravel Casts
## Installation
To install in Laravel 5.1 (lts) or Laravel 5.3 (current):
```sh
composer require genealabs/laravel-casts
```

## Rationale
This package is an effort to streamline and make form development more
 efficient in Laravel Blade views.

### Features
- Support for common CSS frameworks. (At this time only Bootstrap 3 and
 Bootstrap 4.alpha.3, more coming soon.)
- Blade directives for elegant Blade view integration, providing concise
 syntax, reducing form boilerplate 10-fold.
 - DateTime Picker for Bootstrap 3.

## Requirements
- PHP 7.0+
- Laravel 5.1 (LTS) or Laravel 5.3 (Current)

## Usage
### Blade Directives
The following Blade directives developing forms a snap:
```blade
@form(['url' => ''])
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
    @submit('submit', ['class' => 'btn btn-success', 'label' => 'Submit Button'])
@endform
```

### Controls
All controls are built on top of the
 [LaravelCollective HTML package](https://laravelcollective.com/docs/5.3/html).
 As such, they support all the options and syntax provided through that package,
 in addition to the setting detailed below. For the sake of brevity, the
 examples are written using Blade directives. However, all directives are also
 implementable through the standard `Form` alias as identified in each
 heading.

#### `@form` / `{!! Form::open() !!}`
```blade
@form(['class' => '', 'labelWidth' => '', 'fieldWidth' => '', 'framework' => ''])
```

- `class`: (optional)
- `offset`: (optional, default: 3)
- `labelWidth`: (optional, default: 3)
- `fieldWidth`: (optional, default: 9)
- `framework`: (optional)

#### `@label` / `{!! Form::label() !!}`
```blade
@label($name, $label = null, array $options = [], $escapeHtml = true)
```

- `$name`: used for the `for=` attribute on the label.
- `$label`: (default: null) the label text.
- `$options`: (default: []) array of options, including `class`.
- `$escapeHtml`: (default: true) set this to false if your label should render
 HTML.

**Note:** labels are rendered automatically when using frameworks.

#### Input controls
The following controls use the same syntax:
- `@text` / `{!! Form::text() !!}`
- `@date` / `{!! Form::date() !!}`
- `@datetime` / `{!! Form::datetime() !!}`
- `@email` / `{!! Form::email() !!}`
- `@url` / `{!! Form::url() !!}`
- `@textarea` / `{!! Form::textarea() !!}`

```blade
@text($name, $value = null, $options = [])
```

- `$name`: name of the control, used to submit form values.
- `$value`: (default: null) value of the control, if you need to prepopulate it.
 It will automatically populate old form values if validation fails.
- `$options`: (default: []) array of options, including `class`.

#### `@select` / `{!! Form::select() !!}`
```blade
@select($name, $list = [], $selected = null, $options = [])
```

- `$name`: name of the control, used to submit form values.
- `$list`: (default: []) array of key-value pairs used to create the select list
 options.
- `$selected`: (default: null) the value of the selected options.
- `$options`: (default: []) array of options, including `class`.

#### `@selectRangeWithInterval` / `{!! Form::selectRangeWithInterval() !!}`
```blade
@selectRangeWithInterval(string $name, int $start, int $end, int $interval, int $value = null, array $options = [])
```

- `$name`: name of the control, used to submit form values.
- `$start`: starting value of the list.
- `$end`: ending value of the list.
- `$interval`: interval value.
- `$value`: selected value.
- `$options`: (default: []) array of options, including `class`.

### CSS Framework Support
Taking advantage of framework support will handle all error validation
 presentation, as well as generation of labels and all the necessary form
 control boilerplate.

Additional framework support is planned, possibly including:
- Foundation
- Skeleton
- Semantic UI

If there's a framework you would like included, feel free to reach out by
 opening an issue with the pertinent details.

#### Bootstrap 3
To have a form render for Bootstrap 3, specify the framework and form
 orientation in the `@form` directive:
```blade
@form(['url' => '', 'class' => 'form-horizontal', 'framework' => 'bootstrap3'])
```

Additionally, to enable the date/time picker, add the following to your
 JavaScript file for the page rendering the date fields:
 ```js
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
 ```

You can include the library using Gulp and NPM (preferred), or use a CDN.

##### Gulp / NPM
1. `npm install save-dev bootstrap-datetimepicker-npm`
2. Then require the library in your `/resources/assets/js/app.js` file (after jQuery and Bootstrap have been required):
  ```
  require('bootstrap-datetimepicker-npm');
  ```
3. Don't forget to include the CSS as well in `/resources/assets/sass/app.sass`:
  ```
  // DateTimePicker
  @import "./node_modules/bootstrap-datetimepicker-npm/src/sass/bootstrap-datetimepicker-build";
  ```
4. Finally, edit your `/gulpfile.js` as needed, and run `gulp`.

##### CDNs
Add the following references to the page(s) or your main layout file. You will
need to have jQuery and Bootstrap libraries included as well.
```html
<html>
    <head>
        <!-- ... -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.datetimepicker/4.17.42/css/bootstrap-datetimepicker.min.css">
        <!-- ... -->
    </head>
    <body>
        <!-- ... -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/bootstrap.datetimepicker/4.17.42/js/bootstrap-datetimepicker.min.js"></script>
    </body>
</html>
```

#### Bootstrap 4 (alpha 3)
Nearly the same as above:
```blade
@form(['url' => '', 'class' => 'form-horizontal', 'framework' => 'bootstrap4'])
```

## Testing
- Add the following entry to your `phpunit.xml` config file:
  ```xml
<!--
  <testsuites>
      <testsuite name="Application Test Suite">
-->
          <directory suffix="Test.php">./vendor/genealabs/laravel-casts/tests</directory>
<!--
      </testsuite>
  </testsuites>
-->
  ```

- Run `vendor/bin/phpunit` from the base directory of your project.
