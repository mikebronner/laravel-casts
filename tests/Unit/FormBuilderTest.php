<?php namespace GeneaLabs\LaravelCasts\Tests\Unit;

use GeneaLabs\LaravelCasts\Tests\UnitTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;

class FormBuilderTest extends UnitTestCase
{
    public function testFormBladeDirective()
    {
        $string = "@form (['url' => '/', 'method' => 'PATCH', 'framework' => 'vanilla', 'class' => 'form-horizontal'])";
        $expected = "<?php echo app('form')->form(['url' => '/', 'method' => 'PATCH', 'framework' => 'vanilla', 'class' => 'form-horizontal']); ?>";
        $expectedHtml = '<form method="POST" action="http://localhost" accept-charset="UTF-8" class="form-horizontal"><input id="_method" name="_method" type="hidden" value="PATCH"><input id="_token" name="_token" type="hidden">';

        $compiled = app('blade.compiler')->compileString($string);
        $html = (string) app('form')->form(['url' => '/', 'method' => 'PATCH', 'framework' => 'vanilla', 'class' => 'form-horizontal']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testFormModelBladeDirective()
    {
        $model = new stdClass;
        $string = "@form (\$model, ['url' => '/', 'method' => 'PATCH', 'framework' => 'vanilla', 'class' => 'form-horizontal'])";
        $expected = "<?php echo app('form')->form(\$model, ['url' => '/', 'method' => 'PATCH', 'framework' => 'vanilla', 'class' => 'form-horizontal']); ?>";
        $expectedHtml = '<form method="POST" action="http://localhost" accept-charset="UTF-8" class="form-horizontal"><input id="_method" name="_method" type="hidden" value="PATCH"><input id="_token" name="_token" type="hidden">';

        $compiled = app('blade.compiler')->compileString($string);
        $html = (string) app('form')->form($model, ['url' => '/', 'method' => 'PATCH', 'framework' => 'vanilla', 'class' => 'form-horizontal']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testEndformBladeDirective()
    {
        $string = "@endform";
        $expected = "<?php echo app('form')->close(); ?>";
        $expectedHtml = '</form>';

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->close();

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testTokenBladeDirective()
    {
        $string = "@token";
        $expected = "<?php echo app('form')->token(); ?>";
        $expectedHtml = '<input id="_token" name="_token" type="hidden">';

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->token();

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testLabelBladeDirective()
    {
        $string = "@label ('field-name', 'Label Text')";
        $expected = "<?php echo app('form')->label('field-name', 'Label Text'); ?>";
        $expectedHtml = '<label for="field-name" class="control-label">Label Text</label>';

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->label('field-name', 'Label Text');

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testTextBladeDirective()
    {
        $string = "@text ('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->text('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<input placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control blue\" name=\"input-field\" type=\"text\" value=\"test text\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->text('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testTelBladeDirective()
    {
        $string = "@tel ('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->tel('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<input placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control blue\" name=\"input-field\" type=\"tel\" value=\"test text\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->tel('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testMonthBladeDirective()
    {
        $string = "@month ('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->month('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<input placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control blue\" name=\"input-field\" type=\"month\" value=\"test text\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->month('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testWeekBladeDirective()
    {
        $string = "@week ('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->week('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<input placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control blue\" name=\"input-field\" type=\"week\" value=\"3\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->week('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testSearchBladeDirective()
    {
        $string = "@search ('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->search('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<input placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control blue\" name=\"input-field\" type=\"search\" value=\"3\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->search('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testRangeBladeDirective()
    {
        $string = "@range ('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->range('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<input placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control blue\" name=\"input-field\" type=\"range\" value=\"3\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->range('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testNumberBladeDirective()
    {
        $string = "@number ('input-field', 5, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->number('input-field', 5, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<input placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control blue\" name=\"input-field\" type=\"number\" value=\"5\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->number('input-field', 5, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testColorBladeDirective()
    {
        $string = "@color ('input-field', '#ff0000', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->color('input-field', '#ff0000', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<input placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control blue\" name=\"input-field\" type=\"color\" value=\"#ff0000\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->color('input-field', '#ff0000', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testEmailBladeDirective()
    {
        $string = "@email ('email-input', 'test email', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->email('email-input', 'test email', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<input placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control blue\" name=\"input-field\" type=\"email\" value=\"test text\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->email('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testPasswordBladeDirective()
    {
        $string = "@password ('input-field', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->password('input-field', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<input placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control blue\" name=\"input-field\" type=\"password\" value=\"\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->password('input-field', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testUrlBladeDirective()
    {
        $string = "@url ('input-field', 'test url', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->url('input-field', 'test url', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<input placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control blue\" name=\"input-field\" type=\"url\" value=\"test url\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->url('input-field', 'test url', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testFileBladeDirective()
    {
        $string = "@file ('input-field', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->file('input-field', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<input placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control form-control-file blue\" name=\"input-field\" type=\"file\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->file('input-field', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testTextareaBladeDirective()
    {
        $string = "@textarea ('input-field', 'example text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->textarea('input-field', 'example text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<textarea placeholder=\"Placeholder\" id=\"input-field\" class=\"form-control blue\" name=\"input-field\" cols=\"50\" rows=\"10\">example text</textarea>\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->textarea('input-field', 'example text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testComboboxBladeDirective()
    {
        $string = "@combobox ('input-field', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->combobox('input-field', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Input Field</label>    \n<select id=\"input-field\" class=\"form-control selectize\" name=\"input-field\"><option value=\"class\">blue</option><option value=\"placeholder\">Placeholder</option><option value=\"label\">Text field label</option></select>\n\n\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->combobox('input-field', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testSelectBladeDirective()
    {
        $string = "@select ('input-field', ['test1', 'test2', 'test3'], 'test1', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->select('input-field', ['test1', 'test2', 'test3'], 'test1', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<select id=\"input-field\" class=\"form-control blue\" name=\"input-field\"><option value=\"\" disabled=\"disabled\">Placeholder</option><option value=\"0\">test1</option><option value=\"1\">test2</option><option value=\"2\">test3</option></select>\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->select('input-field', ['test1', 'test2', 'test3'], 'test1', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testSelectMonthsBladeDirective()
    {
        $string = "@selectMonths ('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->selectMonths('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<select id=\"input-field\" class=\"form-control blue\" name=\"input-field\"><option value=\"\" disabled=\"disabled\">Placeholder</option><option value=\"1\">January</option><option value=\"2\">February</option><option value=\"3\" selected=\"selected\">March</option><option value=\"4\">April</option><option value=\"5\">May</option><option value=\"6\">June</option><option value=\"7\">July</option><option value=\"8\">August</option><option value=\"9\">September</option><option value=\"10\">October</option><option value=\"11\">November</option><option value=\"12\">December</option></select>\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->selectMonths('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testSelectWeekdaysBladeDirective()
    {
        $string = "@selectWeekdays ('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->selectWeekdays('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<select id=\"input-field\" class=\"form-control blue\" name=\"input-field\"><option value=\"\" disabled=\"disabled\">Placeholder</option><option value=\"1\">Sunday</option><option value=\"2\">Monday</option><option value=\"3\" selected=\"selected\">Tuesday</option><option value=\"4\">Wednesday</option><option value=\"5\">Thursday</option><option value=\"6\">Friday</option><option value=\"7\">Saturday</option></select>\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->selectWeekdays('input-field', 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testSelectRangeWithIntervalBladeDirective()
    {
        $string = "@selectRangeWithInterval ('input-field', 1, 5, 2, 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->selectRangeWithInterval('input-field', 1, 5, 2, 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<select id=\"input-field\" class=\"form-control blue\" name=\"input-field\"><option value=\"\" disabled=\"disabled\">Placeholder</option><option value=\"1\">1</option><option value=\"3\" selected=\"selected\">3</option><option value=\"5\">5</option></select>\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->selectRangeWithInterval('input-field', 1, 5, 2, 3, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testDateBladeDirective()
    {
        $string = "@date ('input-field', null, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->date('input-field', null, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<div class=\"input-group date\" id=\"datetimepicker-input-field\" data-target-input=\"nearest\">\n    <input placeholder=\"Placeholder\" autocomplete=\"noway\" data-target=\"datetimepicker-input-field\" id=\"input-field\" class=\"form-control datetimepicker-input blue\" name=\"input-field\" type=\"date\">\n    <span class=\"input-group-addon\" data-target=\"#datetimepicker-input-field\" data-toggle=\"datetimepicker\">\n        <i class=\"fa fa-btn fa-calendar\"></i>\n    </span>\n</div>\n\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->date('input-field', null, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);
        $html = preg_replace('/data-target="datetimepicker-input-field(.*?)"/', "data-target=\"datetimepicker-input-field\"", $html);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testDatetimeBladeDirective()
    {
        $string = "@datetime ('input-field', null, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->datetime('input-field', null, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<div class=\"input-group date\" id=\"datetimepicker-input-field\" data-target-input=\"nearest\">\n    <input placeholder=\"Placeholder\" autocomplete=\"noway\" data-target=\"datetimepicker-input-field\" id=\"input-field\" class=\"form-control datetimepicker-input blue\" name=\"input-field\" type=\"datetime\">\n    <span class=\"input-group-addon\" data-target=\"#datetimepicker-input-field\" data-toggle=\"datetimepicker\">\n        <i class=\"fa fa-btn fa-calendar\"></i>\n    </span>\n</div>\n\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->datetime('input-field', null, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);
        $html = preg_replace('/data-target="datetimepicker-input-field(.*?)"/', "data-target=\"datetimepicker-input-field\"", $html);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testSignatureBladeDirective()
    {
        $string = "@signature ('input-field', null, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->signature('input-field', null, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n    \n<div class=\"signature input-field\">\n    <div class=\"embed-responsive embed-responsive-16by9 form-control\">\n        <canvas class=\"embed-responsive-item\"></canvas>\n        <div class=\"footer\">\n            <small>\n                <em>Text field label</em>\n                &nbsp;\n\n                            </small>\n            <button type=\"button\" class=\"btn btn-default btn-xs pull-right\" onclick=\"clearSignature('input-field');\">&nbsp;Clear&nbsp;</button>\n        </div>\n        <input id=\"input-field\" name=\"input-field\" type=\"hidden\"><input id=\"input-field_date\" name=\"input-field_date\" type=\"hidden\">\n    </div>\n</div>\n\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->signature('input-field', null, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testCechkboxBladeDirective()
    {
        $string = "@checkbox ('input-field', 'test', true, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->checkbox('input-field', 'test', true, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n    \n<div class=\"checkbox\">\n        <label>\n            <input id=\"input-field\" class=\"blue\" checked=\"checked\" name=\"input-field\" type=\"checkbox\" value=\"test\"> Text field label\n        </label>\n    </div>\n\n    \n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->checkbox('input-field', 'test', true, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testRadioBladeDirective()
    {
        $string = "@radio ('input-field[]', 'test', true, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->radio('input-field[]', 'test', true, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n    \n<div class=\"radio\">\n    <label>\n        <input id=\"input-field[]\" class=\"blue\" checked=\"checked\" name=\"input-field[]\" type=\"radio\" value=\"test\"> Text field label\n    </label>\n</div>\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->radio('input-field[]', 'test', true, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testSwitchBladeDirective()
    {
        $string = "@switch ('input-field', 'test', true, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->switch('input-field', 'test', true, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"control-label\">Text Field Label</label>    \n<div>\n    <input id=\"input-field\" class=\"blue\" checked=\"checked\" name=\"input-field\" type=\"checkbox\" value=\"test\">\n</div>\n\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->switch('input-field', 'test', true, ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testStaticTextBladeDirective()
    {
        $string = "@staticText ('input-field', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->staticText('input-field', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"\" class=\"control-label\">Text Field Label</label>    \n<p class=\"form-control-static\">input-field</p>\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->staticText('input-field', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testSubmitBladeDirective()
    {
        $string = "@submit ('Submit')";
        $expected = "<?php echo app('form')->submit('Submit'); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n                \n<div>\n\n        <button type=\"submit\" class=\"btn btn-primary\">Submit</button>\n\n    </div>\n\n    \n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->submit('Submit');

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testButtonBladeDirective()
    {
        $string = "@button ('Submit', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->button('Submit', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"\" class=\"control-label\">Text Field Label</label>    \n<div>\n\n        <button class=\"btn blue\" type=\"button\">Submit</button>\n\n    </div>\n\n    \n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->button('Submit', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testButtonGroupBladeDirective()
    {
        $string = "@buttonGroup (['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->buttonGroup(['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"\" class=\"control-label\">Text Field Label</label>    \n<div>\n        <div class=\"btn-group blue\">\n\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->buttonGroup(['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testEndButtonGroupBladeDirective()
    {
        $string = "@endButtonGroup ()";
        $expected = "<?php echo app('form')->endButtonGroup(); ?>";
        $expectedHtml = "</div>\n</div>\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->endButtonGroup();

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }
}
