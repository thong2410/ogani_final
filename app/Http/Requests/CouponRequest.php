<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'coupon_event' => 'required|string',
            'type' => 'required|in:money,percent',
            'quantity' => 'required|min:1|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:tomorrow',
            'coupon_value' => 'required|numeric|min:0'
        ];
    }
}
