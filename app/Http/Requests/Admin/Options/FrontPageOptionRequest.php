<?php

namespace App\Http\Requests\Admin\Options;

use Illuminate\Foundation\Http\FormRequest;

class FrontPageOptionRequest extends FormRequest
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
            'title_tax' => 'required|string|min:2|max:50',
            'body_tax'  => 'required|string|min:2|max:10000',
            'faq'       => 'array',
            'image'     => 'image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
