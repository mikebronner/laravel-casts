<?php namespace GeneaLabs\LaravelCasts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormsExample extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'text1' => 'required|string',
            'text2' => 'required|string',
            'password1' => 'required|password',
            'password2' => 'required|password',
            'email1' => 'required|email',
            'email2' => 'required|email',
            'url1' => 'required|url',
            'url2' => 'required|url',
            'file1' => 'required|file',
            'file2' => 'required|file',
            'textarea1' => 'required|string',
            'textarea2' => 'required|string',
            'checkbox1' => 'required',
            'checkbox2' => 'required',
            'switch1' => 'required|string',
            'switch2' => 'required|string',
            'date1' => 'required|date',
            'date2' => 'required|date',
            'datetime1' => 'required|date',
            'datetime2' => 'required|date',
            'select1' => 'required|string',
            'select2' => 'required|string',
            'select_range1' => 'required|number',
            'select_range2' => 'required|number',
            'select_range_with_interval1' => 'required|number',
            'select_range_with_interval2' => 'required|number',
            'combobox1' => 'required|string',
            'combobox2' => 'required|string',
            'signature1' => 'required|image',
            'signature2' => 'required|image',
        ];
    }
}
