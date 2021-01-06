<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'name' => 'required|string',
            'parent_id' => 'sometimes|nullable|numeric',
            'description' => 'nullable|string',
          
        ];
    }

    public function messages()
    {
        return [ 
            'cate_name.required' => trans('admin.validation.required_cate_name'),
        ];
    }
}