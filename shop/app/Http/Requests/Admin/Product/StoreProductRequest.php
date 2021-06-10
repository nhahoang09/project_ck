<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            //
            'name'=>'required',
            'description'=>'required|min:10',
            'thumbnail'=>'required',
            'quantity'=>'required|numeric',
            'status'=>'required',
            'is_feature'=>'required',
            'category_id'=>'required',
        ];
    }
}
