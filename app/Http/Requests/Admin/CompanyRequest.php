<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        return [
            'company_id'         => 'required|string|min:2|max:50',
            'name'               => 'required|string|min:2|max:50',
            'city'               => 'required|string|min:2|max:70',
            'address'            => 'required|string|min:2|max:70',
            'postcode'           => 'required|integer',
            'registration_date'  => 'required|date',
        ];
    }
}
