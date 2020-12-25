<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UpdateUserRequest extends FormRequest
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
    public function rules(User $user)
    {
        return [
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->user->user_id.',user_id',
            'fullname' => 'required|string|max:30',
            'phone' => 'required|string|max:10',
            'gender' => 'required|string|in:male,female',
            'role' => 'required|string|in:member,admin,editor,superadmin',
            'password' => 'sometimes|nullable|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
