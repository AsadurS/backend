<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price'       => 'required|numeric|gt:0',
            'description' => 'required|string|min:15',
            'title'       => 'required|string|min:3|max:255',
            'image'       => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ];
    }
}
