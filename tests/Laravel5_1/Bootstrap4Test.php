<?php namespace GeneaLabs\LaravelCasts\Tests\Laravel5_1;

// use Illuminate\Foundation\Testing\WithoutMiddleware;
// use Illuminate\Foundation\Testing\DatabaseMigrations;
// use Illuminate\Foundation\Testing\DatabaseTransactions;

class Bootstrap4Test extends TestCase
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
                'action' => 'http://localhost',
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
                'name' => 'text',
                'placeholder' => 'Placeholder Text',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'type' => 'text',
                'name' => 'text',
                'label' => 'Text Input',
            ])
            ->seeElement('label', [
                'for' => 'text',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'text',
                'class' => 'col-sm-3 col-form-label',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=text][class="col-sm-3 col-form-label"]',
                'Text Input'
            )
            ->seeStatusCode('200');
    }

    public function testPasswordInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('input', [
                'placeholder' => 'Placeholder Text',
                'class' => 'form-control',
                'name' => 'password',
                'type' => 'password',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'label' => 'Password Input',
                'name' => 'password',
                'type' => 'password',
            ])
            ->seeElement('label', [
                'for' => 'password',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'password',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=password][class="col-sm-3 col-form-label"]',
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
                'name' => 'email',
                'type' => 'email',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'label' => 'Email Input',
                'name' => 'email',
                'type' => 'email',
            ])
            ->seeElement('label', [
                'for' => 'email',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'email',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=email][class="col-sm-3 col-form-label"]',
                'Email Input'
            )
            ->seeStatusCode('200');
    }

    public function testUrlInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('input', [
                'placeholder' => 'Placeholder Text',
                'class' => 'form-control',
                'name' => 'url',
                'type' => 'url',
                'value' => '',
            ])
            ->dontSeeElement('input', [
                'label' => 'Url Input',
                'name' => 'url',
                'type' => 'url',
            ])
            ->seeElement('label', [
                'for' => 'url',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'url',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=url][class="col-sm-3 col-form-label"]',
                'Url Input'
            )
            ->seeStatusCode('200');
    }

    public function testFileInput()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('input', [
                'class' => 'form-control form-control-file',
                'name' => 'file',
                'type' => 'file',
            ])
            ->dontSeeElement('input', [
                'label' => 'Url Input',
                'name' => 'file',
                'type' => 'file',
            ])
            ->dontSeeElement('input', [
                'placeholder' => 'Placeholder Text',
                'name' => 'file',
                'type' => 'file',
            ])
            ->seeElement('label', [
                'for' => 'file',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'file',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=file][class="col-sm-3 col-form-label"]',
                'File'
            )
            ->seeStatusCode('200');
    }

    public function testTextarea()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('textarea', [
                'class' => 'form-control',
                'name' => 'textarea',
                'placeholder' => 'Placeholder Text',
                'rows' => '7',
            ])
            ->dontSeeElement('textarea', [
                'label' => 'Textarea',
                'name' => 'textarea',
            ])
            ->seeElement('label', [
                'for' => 'textarea',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'textarea',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=textarea][class="col-sm-3 col-form-label"]',
                'Textarea'
            )
            ->seeStatusCode('200');
    }

    public function testCheckbox()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('input', [
                'class' => 'form-check-input',
                'name' => 'checkbox',
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
                'for' => 'checkbox',
            ])
            ->seeInElement(
                'label[class="form-check-label"]',
                'Checkbox'
            )
            ->seeInElement(
                'label[class="form-check-label"]',
                '<input class="form-check-input" checked name="checkbox" type="checkbox" value="test">'
            )
            ->seeStatusCode('200');
    }

    public function testSelect()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('select', [
                'class' => 'form-control',
                'name' => 'select',
            ])
            ->dontSeeElement('select', [
                'label' => 'Url Input',
            ])
            ->dontSeeElement('select', [
                'placeholder' => 'Placeholder Text',
            ])
            ->seeElement('label', [
                'for' => 'select',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'select',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=select][class="col-sm-3 col-form-label"]',
                'Select'
            )
            ->seeStatusCode('200');
    }

    public function testSelectRange()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('select', [
                'class' => 'form-control',
                'name' => 'selectRange',
            ])
            ->dontSeeElement('select', [
                'label' => 'SelectRange',
                'name' => 'selectRange',
            ])
            ->dontSeeElement('select', [
                'placeholder' => 'Placeholder Text',
                'name' => 'selectRange',
            ])
            ->seeElement('label', [
                'for' => 'selectRange',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'selectRange',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=selectRange][class="col-sm-3 col-form-label"]',
                'SelectRange'
            )
            ->seeStatusCode('200');
    }

    public function testSelectRangeWithInterval()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('select', [
                'class' => 'form-control',
                'name' => 'selectRangeWithInterval',
            ])
            ->dontSeeElement('select', [
                'name' => 'selectRangeWithInterval',
                'label' => 'SelectRangeWithInterval',
            ])
            ->dontSeeElement('select', [
                'name' => 'selectRangeWithInterval',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeElement('label', [
                'for' => 'selectRangeWithInterval',
                'class' => 'col-sm-3 col-form-label',
            ])
            ->dontSeeElement('label', [
                'for' => 'selectRangeWithInterval',
                'placeholder' => 'Placeholder Text',
            ])
            ->seeInElement(
                'label[for=selectRangeWithInterval][class="col-sm-3 col-form-label"]',
                'SelectRangeWithInterval'
            )
            ->seeStatusCode('200');
    }

    public function testSubmit()
    {
        $this->visit('/genealabs/laravel-casts/examples/bootstrap4')
            ->seeElement('input', [
                'class' => 'btn btn-success btn-primary',
                'type' => 'submit',
                'value' => 'submit',
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
