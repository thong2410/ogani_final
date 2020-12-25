<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
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
            'password' => 'required|min:6|confirmed',
            'old_password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [ 
            'password.required' => trans('main.user_profile.validation.password_required'),
            'password.confirmed' => trans('main.user_profile.validation.password_confirmed'),
            'old_password.required' => trans('main.user_profile.validation.old_password_required'),
        ];
    }
}
