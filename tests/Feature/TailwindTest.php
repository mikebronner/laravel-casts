<?php namespace GeneaLabs\LaravelCasts\Tests\Feature;

use GeneaLabs\LaravelCasts\Tests\FeatureTestCase;
use GeneaLabs\LaravelCasts\Providers\LaravelCastsService;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class TailwindTest extends FeatureTestCase
{
    public function testFormClose()
    {
        $this->get('/genealabs/laravel-casts/examples/tailwind')
            ->see('</form>')
            ->seeStatusCode('200');
    }

    public function testFormOpen()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('form', [
                'method' => 'POST',
                'action' => 'http://localhost/genealabs/laravel-casts/examples/tailwind',
                'accept-charset' => 'UTF-8',
                'class' => 'form-horizontal',
            ])
            ->seeElement('input', [
                'name' => '_token',
            ])
            ->seeStatusCode('200');
    }

    public function testTextInputWithLabel()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
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
            ])
            ->dontSeeElement('label', [
                'for' => 'text',
                'class' => 'col-sm-3 control-label',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=text1]',
                'Text Input'
            )
            ->seeStatusCode('200');
    }

    public function testNumberInputWithLabel()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
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
            ])
            ->dontSeeElement('label', [
                'for' => 'number1',
                'class' => 'col-sm-3 control-label',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=number1]',
                'Number Input'
            )
            ->seeStatusCode('200');
    }

    public function testPasswordInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('input', [
                'placeholder' => 'Placeholder Text',
                'class' => 'form-input',
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
            ])
            ->dontSeeElement('label', [
                'for' => 'password1',
                'class' => 'col-sm-3 control-label',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=password1]',
                'Password'
            )
            ->seeStatusCode('200');
    }

    public function testEmailInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('input', [
                'placeholder' => 'Placeholder Text',
                'class' => 'form-input w-full',
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
            ])
            ->dontSeeElement('label', [
                'for' => 'email1',
                'class' => 'col-sm-3 control-label',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=email1]',
                'Email'
            )
            ->seeStatusCode('200');
    }

    public function testUrlInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('input', [
                'placeholder' => 'Placeholder Text',
                'class' => 'form-input w-full',
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
            ])
            ->dontSeeElement('label', [
                'for' => 'url1',
                'class' => 'col-sm-3 control-label',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=url1]',
                'Url'
            )
            ->seeStatusCode('200');
    }

    public function testFileInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('input', [
                'name' => 'file1',
                'type' => 'file',
            ])
            ->seeElement('input', [
                'id' => 'file1',
                'name' => 'file1',
                'type' => 'file',
            ])
            ->seeElement('label', [
                'for' => 'file1',
            ])
            ->dontSeeElement('label', [
                'for' => 'file1',
                'class' => 'col-sm-3 control-label',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=file1]',
                'File'
            )
            ->seeStatusCode('200');
    }

    public function testTextarea()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('textarea', [
                'class' => 'form-textarea w-full',
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
            ])
            ->dontSeeElement('label', [
                'for' => 'textarea1',
                'class' => 'col-sm-3 control-label',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=textarea1]',
                'Textarea'
            )
            ->seeStatusCode('200');
    }

    public function testCheckbox()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('input', [
                'class' => 'm-0 form-checkbox',
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
                'class' => 'm-0 leading-none',
            ])
            ->dontSeeElement('label', [
                'for' => 'checkbox1',
            ])
            ->seeInElement(
                'label.m-0.leading-none',
                'Checkbox'
            )
            ->seeInElement(
                '.m-0.leading-none',
                '<input id="checkbox1" class="m-0 form-checkbox" checked name="checkbox1" type="checkbox" value="test">'
            )
            ->seeStatusCode('200');
    }

    public function testSelect()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('select', [
                'class' => 'form-select',
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
            ])
            ->dontSeeElement('label', [
                'for' => 'select1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=select1]',
                'Select'
            )
            ->seeStatusCode('200');
    }

    public function testSelectMonths()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('select', [
                'class' => 'form-select',
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
            ])
            ->dontSeeElement('label', [
                'for' => 'selectMonths1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=selectMonths1]',
                'Select'
            )
            ->seeStatusCode('200');
    }

    public function testSelectWeekdays()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('select', [
                'class' => 'form-select',
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
            ])
            ->dontSeeElement('label', [
                'for' => 'selectWeekdays1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=selectWeekdays1]',
                'Select'
            )
            ->seeStatusCode('200');
    }

    public function testSelectRange()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('select', [
                'class' => 'form-select',
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
            ])
            ->dontSeeElement('label', [
                'for' => 'select_range1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=select_range1]',
                'Select Range'
            )
            ->seeStatusCode('200');
    }

    public function testSelectRangeWithInterval()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('select', [
                'class' => 'form-select',
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
            ])
            ->dontSeeElement('label', [
                'for' => 'select_range_with_interval1',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=select_range_with_interval1]',
                'Select Range With Interval'
            )
            ->seeStatusCode('200');
    }

    public function testSubmit()
    {
        $this->visit('/genealabs/laravel-casts/examples/tailwind')
            ->seeElement('button', [
                'class' => 'primary',
                'type' => 'submit'
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

    // public function testDate()
    // {
    //     $this->visit('/genealabs/laravel-casts/examples/tailwind')
    //         ->seeElement('input', [
    //             'class' => 'form-control datetimepicker-input',
    //             'name' => 'date1',
    //             'type' => 'date',
    //             'value' => '',
    //         ])
    //         ->dontSeeElement('input', [
    //             'label' => 'Date Input',
    //             'name' => 'date1',
    //             'type' => 'date',
    //         ])
    //         ->seeElement('label', [
    //             'for' => 'date1',
    //             'class' => 'col-sm-3 control-label',
    //         ])
    //         ->dontSeeElement('label', [
    //             'for' => 'date1',
    //             'placeholder' => 'Placeholder Text',
    //         ])
    //         ->seeInElement(
    //             'label[for=date1]',
    //             'Date1'
    //         )
    //         ->seeStatusCode('200');
    // }
    //
    // public function testDateTime()
    // {
    //     $this->visit('/genealabs/laravel-casts/examples/tailwind')
    //         ->seeElement('input', [
    //             'class' => 'form-control datetimepicker-input',
    //             'name' => 'datetime1',
    //             'type' => 'datetime',
    //             'value' => '',
    //         ])
    //         ->dontSeeElement('input', [
    //             'label' => 'DateTime Input',
    //             'name' => 'datetime1',
    //             'type' => 'datetime',
    //         ])
    //         ->seeElement('label', [
    //             'for' => 'datetime1',
    //             'class' => 'col-sm-3 control-label',
    //         ])
    //         ->dontSeeElement('label', [
    //             'for' => 'datetime1',
    //             'placeholder' => 'Placeholder Text',
    //         ])
    //         ->seeInElement(
    //             'label[for=datetime1]',
    //             'Date'
    //         )
    //         ->seeStatusCode('200');
    // }
}
