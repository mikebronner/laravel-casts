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
        $expectedHtml = '<form method="POST" action="http://localhost" accept-charset="UTF-8" framework="vanilla" class="form-horizontal"><input name="_method" type="hidden" value="PATCH"><input name="_token" type="hidden">';

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->form(['url' => '/', 'method' => 'PATCH', 'framework' => 'vanilla', 'class' => 'form-horizontal']);

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testFormModelBladeDirective()
    {
        $model = new stdClass;
        $string = "@form (\$model, ['url' => '/', 'method' => 'PATCH', 'framework' => 'vanilla', 'class' => 'form-horizontal'])";
        $expected = "<?php echo app('form')->form(\$model, ['url' => '/', 'method' => 'PATCH', 'framework' => 'vanilla', 'class' => 'form-horizontal']); ?>";
        $expectedHtml = '<form method="POST" action="http://localhost" accept-charset="UTF-8" framework="vanilla" class="form-horizontal"><input name="_method" type="hidden" value="PATCH"><input name="_token" type="hidden">';

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->form($model, ['url' => '/', 'method' => 'PATCH', 'framework' => 'vanilla', 'class' => 'form-horizontal']);

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
        $expectedHtml = '<input name="_token" type="hidden">';

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->token();

        $this->assertEquals($expected, $compiled);
        $this->assertEquals($expectedHtml, $html);
    }

    public function testTextBladeDirective()
    {
        $string = "@text ('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label'])";
        $expected = "<?php echo app('form')->text('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']); ?>";
        $expectedHtml = "<div class=\"form-group\">\n\n            <label for=\"input-field\" class=\"blue control-label\">Text field label</label>    \n<input class=\"blue form-control\" placeholder=\"Placeholder\" name=\"input-field\" type=\"text\" value=\"test text\">\n\n\n\n\n    </div>\n";

        $compiled = app('blade.compiler')->compileString($string);
        $html = app('form')->text('input-field', 'test text', ['class' => 'blue', 'placeholder' => 'Placeholder', 'label' => 'Text field label']);

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
}
