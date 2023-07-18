<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductData extends FormRequest
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
            //商品情報(productsテーブル)
            'name' => 'required|max:30',
            'price' => 'required|min:3|numeric',
            'detail' => 'required|max:30',
            'image_file_products' => 'required',
            'situation' => 'max:300',
        ];
    }
 
}
