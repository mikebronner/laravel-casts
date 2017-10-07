<?php namespace GeneaLabs\LaravelCasts\Tests\Feature;

use GeneaLabs\LaravelCasts\Tests\FeatureTestCase;
use GeneaLabs\LaravelCasts\Providers\LaravelCastsService;

class Bootstrap3Test extends FeatureTestCase
{
    public function testFormClose()
    {
        $this->get('/genealabs/laravel-casts/examples/bootstrap3')
            ->see('</form>')
            ->seeStatusCode('200');
    }

    public function testFormOpen()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('form', [
                'method' => 'POST',
                'action' => 'http://localhost/genealabs/laravel-casts/examples/bootstrap3',
                'accept-charset' => 'UTF-8',
                'class' => 'form-horizontal',
                'framework' => 'bootstrap3',
            ])
            ->seeElement('input', [
                'name' => '_token',
            ])
            ->seeStatusCode('200');
    }

    public function testTextInputWithLabel()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('input', [
                'type' => 'text',
                'name' => 'text1',
                'placeholder' => 'Placeholder Text',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'type' => 'text',
                'name' => 'text',
                'label' => 'Text Input',
            ])
            ->seeElement('label', [
                'for' => 'text1',
                'class' => 'col-sm-3 control-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'text',
                'class' => 'col-sm-3 control-label',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=text1][class="col-sm-3 control-label"]',
                'Text Input'
            )
            ->seeStatusCode('200');
    }

    public function testPasswordInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('input', [
                'placeholder' => 'Placeholder Text',
                'class' => 'form-control',
                'name' => 'password1',
                'type' => 'password',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'label' => 'Password Input',
                'name' => 'password',
                'type' => 'password',
            ])
            ->seeElement('label', [
                'for' => 'password1',
                'class' => 'col-sm-3 control-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'password1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=password1][class="col-sm-3 control-label"]',
                'Password'
            )
            ->seeStatusCode('200');
    }

    public function testEmailInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('input', [
                'placeholder' => 'Placeholder Text',
                'class' => 'form-control',
                'name' => 'email1',
                'type' => 'email',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'label' => 'Email Input',
                'name' => 'email',
                'type' => 'email',
            ])
            ->seeElement('label', [
                'for' => 'email1',
                'class' => 'col-sm-3 control-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'email1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=email1][class="col-sm-3 control-label"]',
                'Email'
            )
            ->seeStatusCode('200');
    }

    public function testUrlInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('input', [
                'placeholder' => 'Placeholder Text',
                'class' => 'form-control',
                'name' => 'url1',
                'type' => 'url',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'label' => 'Url Input',
                'name' => 'url1',
                'type' => 'url',
            ])
            ->seeElement('label', [
                'for' => 'url1',
                'class' => 'col-sm-3 control-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'url1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=url1][class="col-sm-3 control-label"]',
                'Url'
            )
            ->seeStatusCode('200');
    }

    public function testFileInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('input', [
                'class' => 'form-control form-control-file',
                'name' => 'file1',
                'type' => 'file',
            ])
            ->dontSeeElement('input', [
                'label' => 'Url Input',
                'name' => 'file1',
                'type' => 'file',
            ])
            ->dontSeeElement('input', [
                'placeholder' => 'Placeholder Text',
                'name' => 'file1',
                'type' => 'file',
            ])
            ->seeElement('label', [
                'for' => 'file1',
                'class' => 'col-sm-3 control-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'file1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=file1][class="col-sm-3 control-label"]',
                'File'
            )
            ->seeStatusCode('200');
    }

    public function testTextarea()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('textarea', [
                'class' => 'form-control',
                'name' => 'textarea1',
                'placeholder' => 'Placeholder Text',
                'rows' => '7',
            ])
            ->dontSeeElement('textarea', [
                'label' => 'Textarea',
                'name' => 'textarea1',
            ])
            ->seeElement('label', [
                'for' => 'textarea1',
                'class' => 'col-sm-3 control-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'textarea1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=textarea1][class="col-sm-3 control-label"]',
                'Textarea'
            )
            ->seeStatusCode('200');
    }

    public function testCheckbox()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('input', [
                'class' => '',
                'name' => 'checkbox1',
                'type' => 'checkbox',
                'checked' => 'checked',
                'value' => 'test',
            ])
            ->dontSeeElement('input', [
                'label' => 'Checkbox',
                'type' => 'checkbox',
            ])
            ->dontSeeElement('input', [
                'placeholder' => 'Placeholder Text',
                'type' => 'checkbox',
            ])
            ->seeElement('div', [
                'class' => 'checkbox',
            ])
            ->dontSeeElement('label', [
                'for' => 'checkbox1',
            ])
            ->seeInElement(
                'div.checkbox',
                'Checkbox'
            )
            ->seeInElement(
                '.checkbox',
                '<input class="" checked name="checkbox1" type="checkbox" value="test">'
            )
            ->seeStatusCode('200');
    }

    public function testSelect()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('select', [
                'class' => 'form-control',
                'name' => 'select1',
            ])
            ->dontSeeElement('select', [
                'label' => 'Url Input',
            ])
            ->dontSeeElement('select', [
                'placeholder' => 'Placeholder Text',
            ])
            ->seeElement('label', [
                'for' => 'select1',
                'class' => 'col-sm-3 control-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'select1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=select1][class="col-sm-3 control-label"]',
                'Select'
            )
            ->seeStatusCode('200');
    }

    public function testSelectRange()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('select', [
                'class' => 'form-control',
                'name' => 'select_range1',
            ])
            ->dontSeeElement('select', [
                'label' => 'SelectRange',
                'name' => 'select_range1',
            ])
            ->dontSeeElement('select', [
                'placeholder' => 'Placeholder Text',
                'name' => 'select_range1',
            ])
            ->seeElement('label', [
                'for' => 'select_range1',
                'class' => 'col-sm-3 control-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'select_range1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=select_range1][class="col-sm-3 control-label"]',
                'Select Range'
            )
            ->seeStatusCode('200');
    }

    public function testSelectRangeWithInterval()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('select', [
                'class' => 'form-control',
                'name' => 'select_range_with_interval1',
            ])
            ->dontSeeElement('select', [
                'name' => 'select_range_with_interval1',
                'label' => 'SelectRangeWithInterval',
            ])
            ->dontSeeElement('select', [
                'name' => 'select_range_with_interval1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeElement('label', [
                'for' => 'select_range_with_interval1',
                'class' => 'col-sm-3 control-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'select_range_with_interval1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=select_range_with_interval1][class="col-sm-3 control-label"]',
                'Select Range With Interval'
            )
            ->seeStatusCode('200');
    }

    public function testSubmit()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('input', [
                'class' => 'btn btn-success btn-primary',
                'type' => 'submit',
                'value' => 'submit1',
            ])
            ->dontSeeElement('input', [
                'type' => 'submit',
                'label' => 'Submit Button',
            ])
            ->dontSeeElement('input', [
                'type' => 'submit',
                'placeholder' => 'Placeholder Text',
            ])
            ->dontSeeElement('label', [
                'for' => 'submit',
            ])
            ->seeStatusCode('200');
    }

    public function testDate()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('input', [
                'class' => 'form-control datetimepicker-input',
                'name' => 'date1',
                'type' => 'date',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'label' => 'Date Input',
                'name' => 'date1',
                'type' => 'date',
            ])
            ->seeElement('label', [
                'for' => 'date1',
                'class' => 'datetimepicker-input col-sm-3 control-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'date1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=date1][class="datetimepicker-input col-sm-3 control-label"]',
                'Date1'
            )
            ->seeStatusCode('200');
    }

    public function testDateTime()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap3')
            ->seeElement('input', [
                'class' => 'form-control datetimepicker-input',
                'name' => 'datetime1',
                'type' => 'datetime',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'label' => 'DateTime Input',
                'name' => 'datetime1',
                'type' => 'datetime',
            ])
            ->seeElement('label', [
                'for' => 'datetime1',
                'class' => 'datetimepicker-input col-sm-3 control-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'datetime1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=datetime1][class="datetimepicker-input col-sm-3 control-label"]',
                'Date'
            )
            ->seeStatusCode('200');
    }
}
