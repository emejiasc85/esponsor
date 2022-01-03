<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required',
            'description' => 'required|max:250',
            'stock'       => 'required|min:1',
            'min_price'   => 'required|min:0',
            'file'        => 'required|image',
            'category_id' => 'required|exists:categories,id',

        ];
    }
}