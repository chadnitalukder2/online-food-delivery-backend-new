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
            'user_id' => 'sometimes|exists:users,id', 
            'restaurant_id' => 'sometimes|exists:restaurants,id',
            'menu_id' => 'sometimes|exists:menus,id',
            'total_amount' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|string|in:pending,completed,canceled',
            'payment_status' => 'sometimes|string|in:pending,paid,failed',
            'quantity' => 'sometimes|integer|min:1', 
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|string|max:20',
            'delivery_address' => 'sometimes|string|max:255',
        ];

        if ($this->isMethod('POST')) {
            $rules['user_id'] = 'required|exists:users,id';
            $rules['restaurant_id'] = 'required|exists:restaurants,id';
            $rules['menu_id'] = 'required|exists:menus,id';
            $rules['total_amount'] = 'required|numeric|min:0';
            $rules['status'] = 'required|string|in:pending,completed,canceled';
            $rules['delivery_address'] = 'required|string|max:255';
            $rules['name'] = 'required|string|max:255';
             $rules['email'] = 'required|email|max:255';
             $rules['phone'] = 'required|string|max:20';
        }

        return $rules;
    }
}
