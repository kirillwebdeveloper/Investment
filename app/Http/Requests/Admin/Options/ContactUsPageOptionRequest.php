<?php

namespace App\Http\Requests\Admin\Options;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsPageOptionRequest extends FormRequest
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
            'before-image' => 'nullable|string|min:2|max:10000',
            'after-image'  => 'nullable|string|min:2|max:10000',
            'image'        => 'image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
