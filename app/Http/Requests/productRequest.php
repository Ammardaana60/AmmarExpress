<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productRequest extends FormRequest
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
            'product_name'=>'required|min:5|string',
            'product_quantity'=>'required|integer',
            'product_description'=>'required|String|max:25',
            'product_price'=>'required|integer',
            // 'product_rating'=>'required|integer',
            'brand_id'=>'required|integer',
            'category_id'=>'required|integer',
        ];
    }
}
// product_price