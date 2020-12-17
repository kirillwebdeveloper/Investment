<?php

namespace App\Http\Requests;

use App\Rules\OrderValidation;
use App\Rules\SsnValidation;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize ()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {

        $rules = [
            'name'           => 'required|string|min:2|max:20',
            'email'          => 'required|email',
            'phone'          => 'required|numeric',
            'radio-selected' => 'required',
            'message'        => 'required|string|max:250',
        ];

        if ($this->request->get('radio-selected') == 'security') {
            $rules['ssn-input'] = ['required', 'string', 'min:10', 'max:13', new SsnValidation()];
        }

        if ($this->request->get('radio-selected') == 'order') {
            $rules['order-id'] = ['required', 'string', 'min:1', 'max:20', new OrderValidation()];
        }

        return $rules;
    }

    public function messages ()
    {
        return [
            'ssn-input.required' => 'Please specify your social security number',
            'ssn-input.max'      => 'Social security number may not be larger that 13 characters',
            'ssn-input.min'      => 'Social security number may not be smaller that 10 characters'
        ];
    }
}
