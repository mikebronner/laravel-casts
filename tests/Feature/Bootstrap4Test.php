<?php namespace GeneaLabs\LaravelCasts\Tests\Feature;

use GeneaLabs\LaravelCasts\Tests\FeatureTestCase;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class Bootstrap4Test extends FeatureTestCase
{
    public function testFormClose()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->see('</form>')
            ->seeStatusCode('200');
    }

    public function testFormOpen()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('form', [
                'method' => 'POST',
                'action' => 'http://localhost/genealabs/laravel-casts/examples/bootstrap4',
                'accept-charset' => 'UTF-8',
                'class' => 'form-horizontal',
                'framework' => 'bootstrap4',
            ])
            ->seeElement('input', [
                'name' => '_token',
            ])
            ->seeStatusCode('200');
    }

    public function testTextInputWithLabel()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('input', [
                'type' => 'text',
                'name' => 'text1',
                'placeholder' => 'Placeholder Text',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'type' => 'text',
                'name' => 'text1',
                'label' => 'Text Input',
            ])
            ->seeElement('label', [
                'for' => 'text1',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'text1',
                'class' => 'col-sm-3 col-form-label',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=text1][class="col-sm-3 col-form-label"]',
                'Text'
            )
            ->seeStatusCode('200');
    }

    public function testNumberInputWithLabel()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('input', [
                'type' => 'number',
                'name' => 'number1',
                'placeholder' => 'Placeholder Text',
                'value' => '5',
            ])
            ->dontSeeElement('input', [
                'type' => 'number',
                'name' => 'number1',
                'label' => 'Number Input',
            ])
            ->seeElement('label', [
                'for' => 'number1',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'number1',
                'class' => 'col-sm-3 control-label',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=number1][class="col-sm-3 col-form-label"]',
                'Number Input'
            )
            ->seeStatusCode('200');
    }

    public function testPasswordInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('input', [
                'placeholder' => 'Placeholder Text',
                'class' => 'form-control',
                'name' => 'password1',
                'type' => 'password',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'label' => 'Password Input',
                'name' => 'password1',
                'type' => 'password',
            ])
            ->seeElement('label', [
                'for' => 'password1',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'password1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=password1][class="col-sm-3 col-form-label"]',
                'Password'
            )
            ->seeStatusCode('200');
    }

    public function testEmailInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('input', [
                'placeholder' => 'Placeholder Text',
                'class' => 'form-control',
                'name' => 'email1',
                'type' => 'email',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'label' => 'Email Input',
                'name' => 'email1',
                'type' => 'email',
            ])
            ->seeElement('label', [
                'for' => 'email1',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'email1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=email1][class="col-sm-3 col-form-label"]',
                'Email'
            )
            ->seeStatusCode('200');
    }

    public function testUrlInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
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
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'url1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=url1][class="col-sm-3 col-form-label"]',
                'Url'
            )
            ->seeStatusCode('200');
    }

    public function testFileInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('input', [
                'class' => 'custom-file-input',
                'name' => 'file1',
                'type' => 'file',
            ])
            ->dontSeeElement('input', [
                'label' => 'Url Input',
                'name' => 'file1',
                'type' => 'file',
            ])
            ->seeElement('label', [
                'for' => 'file1',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'file1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=file1][class="col-sm-3 col-form-label"]',
                'File Input'
            )
            ->seeStatusCode('200');
    }

    public function testTextarea()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
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
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'textarea1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=textarea1][class="col-sm-3 col-form-label"]',
                'Textarea'
            )
            ->seeStatusCode('200');
    }

    public function testCheckbox()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('input', [
                'class' => 'form-check-input',
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
            ->seeElement('label', [
                'class' => 'form-check-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'checkbox1',
            ])
            ->seeInElement(
                'label[class="form-check-label"]',
                'Checkbox'
            )
            ->seeInElement(
                'label[class="form-check-label"]',
                '<input class="form-check-input" checked name="checkbox1" type="checkbox" value="test">'
            )
            ->seeStatusCode('200');
    }

    public function testSelect()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('select', [
                'class' => 'form-control custom-select',
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
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'select1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=select1][class="col-sm-3 col-form-label"]',
                'Select'
            )
            ->seeStatusCode('200');
    }

    public function testSelectMonths()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('select', [
                'class' => 'form-control custom-select',
                'name' => 'selectMonths1',
            ])
            ->dontSeeElement('select', [
                'label' => 'Url Input',
            ])
            ->dontSeeElement('select', [
                'placeholder' => 'Placeholder Text',
            ])
            ->seeElement('label', [
                'for' => 'selectMonths1',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'selectMonths1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=selectMonths1][class="col-sm-3 col-form-label"]',
                'Select'
            )
            ->seeStatusCode('200');
    }

    public function testSelectWeekdays()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('select', [
                'class' => 'form-control custom-select',
                'name' => 'selectWeekdays1',
            ])
            ->dontSeeElement('select', [
                'label' => 'Url Input',
            ])
            ->dontSeeElement('select', [
                'placeholder' => 'Placeholder Text',
            ])
            ->seeElement('label', [
                'for' => 'selectWeekdays1',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'selectWeekdays1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=selectWeekdays1][class="col-sm-3 col-form-label"]',
                'Select'
            )
            ->seeStatusCode('200');
    }

    public function testSelectRange()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('select', [
                'class' => 'form-control custom-select',
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
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'select_range1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=select_range1][class="col-sm-3 col-form-label"]',
                'Select Range'
            )
            ->seeStatusCode('200');
    }

    public function testSelectRangeWithInterval()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('select', [
                'class' => 'form-control custom-select',
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
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'select_range_with_interval1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=select_range_with_interval1][class="col-sm-3 col-form-label"]',
                'Select Range With Interval'
            )
            ->seeStatusCode('200');
    }

    public function testSubmit()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('button', [
                'class' => 'btn btn-primary btn-success',
                'type' => 'submit',
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
}
