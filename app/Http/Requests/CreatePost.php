<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePost extends FormRequest
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
            'title' => 'required|string',
            'content' => 'required|string',
            'thumb_id' => 'required|numeric',
            'seo_title' => 'required|string',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string',
        ];
    }

    public function messages()
    {
        return [ 
            'title.required' => trans('admin.blog.validation.required_title'),
            'content.required' => trans('admin.blog.validation.required_content'),
            'thumb_id.required' => trans('admin.blog.validation.required_img'),
        ];
    }
}
