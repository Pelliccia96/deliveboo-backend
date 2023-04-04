<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_name' => 'required',
            'customer_address' => 'required',
            'customer_phone' => 'required',
            'customer_email' => 'required',
            'status' =>'required',
            'total_order' =>'required',
            'order_date' =>'required',
            'order_time' =>'required',
            'restaurant_id' => 'required',
            'dish_id' => 'required',
              
        ];
    }
}