<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
 
        $rules = [
            'restaurant_id' => 'sometimes|exists:restaurants,id',
            'user_id' => 'sometimes|exists:users,id',
            'total_amount' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|string',
            'payment_status' => 'sometimes|string',
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|integer',
            'delivery_address' => 'sometimes|string|max:255',
        ];

        if ($this->isMethod('POST')) {
            $rules['restaurant_id'] = 'required|exists:restaurants,id';
            $rules['user_id'] = 'required|exists:users,id';
            $rules['total_amount'] = 'required|numeric|min:0';
            $rules['delivery_address'] = 'required|string|max:255';
            $rules['name'] = 'required|string|max:255';
             $rules['email'] = 'required|email|max:255';
             $rules['phone'] = 'required|integer';
        }

        return $rules;
    }
}
