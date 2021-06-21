<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'category_id' => 'required',
                'name' => 'required|max:50',
                'description' => 'required|min:10|max:255',
                'brand' => 'required|max:50',
                'price' => 'required|integer|min:1',
                'colorArr' => 'required',
                'sizeValue' => 'required',
                'imagesArr.*' => 'required|mimes:jpeg,png,jpg,gif,svg',
                'isMain' => 'required'
        ];
    }
}
